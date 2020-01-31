<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html


	namespace Cookiemanager\helper\objects;


	class WebObject
  {

    private $db;

    private $init;

    private $httpvars;

    private $checksum;

    public $obj;


      function __construct(&$init, &$db, &$httpvars)
    	{

        $this->db = $db;

        $this->init = $init;

        $this->httpvars = $httpvars;

        $this->obj = (object)[

            'id' => $this->init->websiteid,
            'host' => $this->init->webhost,
            'cmurl' => $this->httpvars->appurl,
            'cmchecksum' => "",
            'userid' => $this->init->userid,
            'userreg' => date("d.m.Y H:i:s", $this->init->regdate),
            'fingerprinturl' => $this->httpvars->appurl . "img/fingerprint.png",
            'logourl' => $this->httpvars->appurl . "img/logo.png",
            'switchon' => $this->httpvars->appurl . "img/on.png",
            'switchoff' => $this->httpvars->appurl . "img/off.png",
            'categories' => (object)[],
            'cookiebar' => (object)[],
            'cookiebox' => (object)[]

        ];

        $this->generateObjects();

        $this->styleCat();

        $this->styleCatCookies();

        $this->obj->cmchecksum = hash('sha1', $this->checksum);

			}

      function __destruct()
      {

        print json_encode($this->obj);

      }

      private function convertStringLiterals($stream) : string
      {

        $stream = str_replace("\n", "<br>", $stream);
        return preg_replace('/[\n\r\b\t]*/', '', $stream);

      }

      private function styleCatCookies() : void
      {

        $checksum = "";
        $cookiescount = 0;

        foreach($this->obj->categories as $wert){

          $tmparr = [];
          $i=0;

          $this->db->sql = " SELECT

                              a.id AS cookieid,
                              a.company AS companyid,
                              a.name AS cookiename,
                              a.beschreibung AS cookiebeschreibung,
                              a.personenbezogenedaten AS cookiepersonenbezogenedaten,
                              a.landderdatenerfassung AS cookielandderdatenerfassung,
                              a.wirdgeloeschtnach AS cookiewirdgeloeschtnach,
                              a.opttype AS cookieopttype,
                              CONCAT(d.name, \"\n\", d.strasse, \"\n\", d.ort, \"\n\", d.land) AS company,
                              (
                                SELECT aa.zeitpunkt FROM `" . $this->init->opttable . "` aa WHERE aa.usertoken=? AND (aa.websiteid=? AND aa.cookieid=a.id) AND aa.allowlevel=1
                              ) AS optin,
                              d.impressum AS companyimpressum,
                              d.datenschutz AS companydatenschutz

                              FROM cookies a
                              LEFT JOIN cookies2categories b ON b.cookie = a.id
                              LEFT JOIN cookies2websites c ON c.cookie = a.id
                              LEFT JOIN cookie_companies d ON d.id = a.company

                              WHERE (b.category=? AND c.website=?) AND (a.active='1' AND a.deleted='0' AND d.deleted='0')

                              ORDER BY a.name ASC

          ";

          $this->db->datain = [$this->init->userid, $this->obj->id, $wert->catid, $this->obj->id];
          $this->db->executeMultiStm();

          while($line = $this->db->statement->fetch()){

           $this->checksum .= $line["cookieid"] . $line["companyid"] . $line["cookiename"] . $line["cookiebeschreibung"] . $line["cookiepersonenbezogenedaten"] . $line["cookielandderdatenerfassung"] . $line["cookiewirdgeloeschtnach"] . $line["cookieopttype"] . $line["company"];

           $switcher = (is_null($line["optin"]))?(($wert->catid === 1 || ($line["cookieopttype"]=="2" && $this->init->firstreg===true))?("on"):("off")):("on");
           $optin = (is_null($line["optin"]))?(($wert->catid === 1)?("Essential"):("-")):(date("d.m.Y H:i:s", (int)$line["optin"]));

           $tmparr[$i] = (object)[

                              'cookieid' => (int)$line["cookieid"],
                              'companyid' => (int)$line["companyid"],
                              'cookiestatus' => ($switcher === "on")?("1"):("0"),
                              'cookieswitcher' => $this->httpvars->appurl . "img/" . $switcher . ".png",
                              'cookieessential' => ($wert->catid === 1)?("1"):("0"),
                              'cookieoptin' => $optin,
                              'cookiename' => trim($this->convertStringLiterals($line["cookiename"])),
                              'cookiebeschreibung' => trim($this->convertStringLiterals($line["cookiebeschreibung"])),
                              'cookiepersonenbezogenedaten' => trim($this->convertStringLiterals($line["cookiepersonenbezogenedaten"])),
                              'cookielandderdatenerfassung' => trim($this->convertStringLiterals($line["cookielandderdatenerfassung"])),
                              'cookiewirdgeloeschtnach' => trim($this->convertStringLiterals($line["cookiewirdgeloeschtnach"])),
                              'cookieopttype' => (int)$line["cookieopttype"],
                              'company' => trim($this->convertStringLiterals($line["company"])),
                              'companyimpressum' => trim($this->convertStringLiterals($line["companyimpressum"])),
                              'companydatenschutz' => trim($this->convertStringLiterals($line["companydatenschutz"]))
           ];

          $i++;}

          $wert->cookies = (object)$tmparr;

        }

      }

      private function styleCat() : void
      {

        $tmparr = [];
        $i=0;

        $this->db->sql = " SELECT

                            a.id AS catid,
                            a.name AS name,
                            a.description AS description

                           FROM cookie_categories a
                           LEFT JOIN cookies2categories b ON b.category = a.id
                           LEFT JOIN cookies2websites c ON c.cookie = b.cookie
                           LEFT JOIN cookies d ON d.id = c.cookie

                           WHERE c.website=? AND (d.active='1' AND d.deleted='0')

                           GROUP BY a.id

                           ORDER BY a.id ASC
        ";

        $this->db->datain = [$this->obj->id];
        $this->db->executeMultiStm();

        while($line = $this->db->statement->fetch()){

         $this->checksum .= $line["name"] . $line["description"];

         $tmparr[$i] = (object)['catid' => (int)$line["catid"], 'name' => trim($this->convertStringLiterals($line["name"])), 'description' => trim($this->convertStringLiterals($line["description"])), 'cookies' => []];

        $i++;}

        $this->obj->categories = (object)$tmparr;


      }

      private function styleDb($table, &$obj) : void
      {

        $tmparr = [];
        $this->db->sql = " SELECT

                              a.value AS wert,
                              b.varname AS varname

                            FROM " . $table . " a
                            LEFT OUTER JOIN " . substr($table, 0, 9) . "_vars b ON b.id = a.varid

                            WHERE a.websiteid=?

        ";

        $this->db->datain = [$this->obj->id];
        $this->db->executeMultiStm();

        while($line = $this->db->statement->fetch()){

         $tmparr = array_merge($tmparr, [$line["varname"] => trim($this->convertStringLiterals($line["wert"]))]);

        }

        $obj = (object)$tmparr;

      }

      private function generateObjects() : void
      {

        $this->styleDb("cookiebars", $this->obj->cookiebar);
        $this->styleDb("cookieboxes", $this->obj->cookiebox);

      }

  }?>
