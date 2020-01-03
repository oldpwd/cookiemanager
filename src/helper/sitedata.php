<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html
  # Author SL, JUSTilize GmbH, Frankfurt/Main

	namespace Cookiemanager\helper;


	class Sitedata
  {

			private $db;

      private $site;

      private $sql;

      public $dbobject;

      public $websiteid;

      public $websitetoken;

      public $cookieid = "";

      public $userid = "";

      public $categoryid = "";

      public $companyid = "";

      public $datain = [];

      public $data = [];

      public $dbdata = [];

      public $multidata = [];

      public $hostname;


      function __construct(&$db, &$site)
    	{

        $this->db = $db;

        $this->site = $site;

        $this->dbobject = new objects\DbObject();


        /*Websites*/
        if( $this->site[0] === "websites" ){

          if(isset($this->site[1])){

            if($this->verifyWsId()){

              $this->datain = [$this->websiteid];

              if($this->site[1] === "cookiebar"){

                $this->webElementsFetch('cookiebar', 'cookiebars');

              }else if($this->site[1] === "cookiebox"){

                $this->webElementsFetch('cookiebox', 'cookieboxes');

              }else if($this->site[1] === "cookies"){

                $this->CookiesFetch(true);

              }

            }else{

              header("Location: " . $this->site[0] . ".html");

            }

          }else{

            $this->websiteListingFetch();

          }

        }
        /*Endif websites*/

        if( $this->site[0] === "categories" || $this->site[0] === "settings" || $this->site[0] === "cookies" || $this->site[0] === "companies"){

          if(isset($this->site[1])){

            if($this->verifyDataId($this->dbobject->tablemap[$this->site[0]]) || $this->site[1] === "create"){

              if($this->dbobject->id != ""){

                $this->datain = [$this->dbobject->id];
                if($this->site[0] === "categories"){ $this->categoryFetchData(); $this->categoryid = $this->dbobject->id; }
                if($this->site[0] === "settings"){ $this->userFetchData(); $this->userid = $this->dbobject->id; }
                if($this->site[0] === "cookies"){ $this->CookieFetchData(); $this->cookieid = $this->dbobject->id; }
                if($this->site[0] === "companies"){ $this->companyFetchData(); $this->companyid = $this->dbobject->id; }

              }

            }else{

              header("Location: " . $this->site[0] . ".html");

            }

          }else{

            if($this->site[0] === "categories"){ $this->CategoryFetch(); }
            if($this->site[0] === "settings"){ $this->UserFetch(); }
            if($this->site[0] === "cookies"){ $this->CookiesFetch(); }
            if($this->site[0] === "companies"){ $this->CompanyFetch(); }

          }

        }

        if($this->sql != ""){

          $this->executeDb();
          $this->fetchDbLines();

        }

			}

      public function dbdataPushData($field) : string
      {

        if(isset($this->dbdata[0][$field])){

          return $this->dbdata[0][$field];

        }

        return "";

      }

      public function cookiePushData($field) : string
      {

        if(isset($this->multidata['cookie'][0][$field])){

          return $this->multidata['cookie'][0][$field];

        }

        return "";

      }

      private function companyFetchData() : void
      {

        $this->sql = "SELECT id, name, strasse, ort, land, url, impressum, datenschutz FROM cookie_companies WHERE id=?";
        $this->executeDb();
        $this->fetchDbElemLines();
        $this->sql = "";

      }

      private function categoryFetchData() : void
      {

        $this->sql = "SELECT id, name, description, active FROM cookie_categories WHERE id=?";
        $this->executeDb();
        $this->fetchDbElemLines();
        $this->sql = "";

      }

      private function userFetchData() : void
      {

        $this->sql = "SELECT id, username, email, active FROM user WHERE id=?";
        $this->executeDb();
        $this->fetchDbElemLines();
        $this->sql = "";

      }

      private function cookieFetchData() : void
      {


        $this->multidata = [];
        $this->sql = " SELECT

                          a.id AS id,
                          a.company AS company,
                          a.name AS name,
                          a.internalremarks AS internalremarks,
                          a.beschreibung AS beschreibung,
                          a.personenbezogenedaten AS personenbezogenedaten,
                          a.landderdatenerfassung AS landderdatenerfassung,
                          a.wirdgeloeschtnach AS wirdgeloeschtnach,
                          a.sourcetype AS sourcetype,
                          a.sourcecode AS sourcecode,
                          a.active AS active,
                          a.deleted AS deleted,
                          b.category AS category

                        FROM cookies a
                        LEFT OUTER JOIN cookies2categories b ON b.cookie = a.id

                        WHERE a.id=?

                    ";

        $this->executeDb();
        $this->fetchDbElemLines();
        $this->multidata['cookie'] = $this->dbdata;
        $this->dbdata = [];
        $this->sql = "SELECT cookie, website FROM cookies2websites WHERE cookie=?";
        $this->executeDb();
        $this->fetchDbElemLines();
        $this->multidata['cookie2websites'] = $this->dbdata;
        $this->dbdata = [];

      }

      public function webElementsFetchCookieRequiredListing($table) : void
      {

        $this->dbdata = [];
        $this->sql = "SELECT id, name FROM " . $table . " WHERE deleted='0' ORDER BY id ASC";
        $this->executeDb();
        $this->fetchDbElemLines();

      }

      private function webElementsFetch($tbvars, $element) : void
      {

        $this->sql = " SELECT

                        a.varname AS varname,
                        a.input AS input,

                        IF(b.value='', a.defaultval, b.value) AS value

                       FROM " . $tbvars . "_vars a

                       LEFT OUTER JOIN " . $element . " b ON b.varid = a.id

                       WHERE b.websiteid=?

                       ";

                     $this->executeDb();
                     $this->fetchDbElemLines();

      }

      private function verifyDataId($table) : bool
      {

        $this->sql = "SELECT id FROM " . $table . " WHERE id=?";
        $this->datain = [(isset($_POST["id"]))?($_POST["id"]):($this->dbobject->id)];

        $this->executeDb();
        $this->data = $this->db->statement->fetch();

        if($this->data["id"]!=''){

          $this->dbobject->id = $this->data["id"];
          return true;

        }

        return false;

      }

      private function verifyWsId() : bool
      {

        $this->sql = "SELECT id, host, token FROM cookie_websites WHERE id=?";
        $this->datain = [(isset($_POST["id"]))?($_POST["id"]):('0')];
        $this->executeDb();
        $this->data = $this->db->statement->fetch();

        if($this->data["id"]!=''){

          $this->websiteid = $this->data["id"];
          $this->websitetoken = $this->data["token"];
          $this->hostname = $this->data["host"];
          return true;

        }

        return false;

      }

      private function CompanyFetch() : void
      {

        $this->sql = "SELECT a.id AS id, a.name AS name, a.url AS url, (SELECT COUNT(b.id) FROM cookies b WHERE b.company = a.id AND b.deleted='0') AS anzcookies FROM cookie_companies a WHERE a.deleted='0'";

      }

      private function CategoryFetch() : void
      {

        $this->sql = "SELECT id, name, description, active FROM cookie_categories WHERE deleted='0'";

      }

      private function UserFetch() : void
      {

        $this->sql = "SELECT id, username, email, active FROM user";

      }

      private function CookiesFetch($website=false) : void
      {

        $this->sql = " SELECT

                         a.id AS cookieid,
                         a.id AS id,
                         a.name AS bezeichnung,
                         a.internalremarks AS internalremarks,
                         a.active AS active,
                         b.name AS company,
                         b.id AS companyid,

                         (

                           SELECT c.id FROM cookie_categories c
                           LEFT JOIN cookies2categories d ON d.category = c.id
                           WHERE d.cookie = a.id AND c.deleted='0'
                           ORDER BY c.id ASC LIMIT 0, 1

                         ) AS firstcatid, ";
       if($website){

         $this->sql .="   (

                             SELECT CASE WHEN COUNT(f.cookie) > 0 THEN '1' ELSE '0' END
                             FROM cookies2websites f WHERE f.website=? AND f.cookie=a.id

                           ) AS thissitecookie, ";

         $this->datain = [$_POST["id"]];

       }

       $this->sql .="    (

                           SELECT COUNT(e.cookie) FROM cookies2websites e WHERE e.cookie = a.id

                         ) AS zugeordnet


                       FROM cookies a

                       LEFT OUTER JOIN cookie_companies b ON b.id = a.company

                       WHERE (a.deleted='0')

                       ORDER BY id DESC, a.name ASC

                       ";


        if($website){

          $this->executeDb();
          $this->fetchDbElemLines();

        }

      }

      private function websiteListingFetch() : void
      {

        $this->sql =  " SELECT

                          a.id AS id,
                          a.host AS host,
                          a.token AS token,
                          a.active AS active,

                          (

                            SELECT COUNT(b.id) FROM cookies b
                            LEFT JOIN cookies2websites c ON c.cookie = b.id
                            WHERE c.website = a.id AND (b.deleted='0' AND b.active='1')

                          ) AS anzahl

                        FROM cookie_websites a

                        WHERE a.deleted='0'

                        ORDER BY a.id DESC

                        ";

      }

      public function cookieWsShortListing($cookieid, $trennzeichen=",") : string
      {

        $ausgabe="";
        $sql = "SELECT a.host AS website FROM cookie_websites a LEFT JOIN cookies2websites b ON b.website=a.id WHERE a.deleted='0' AND b.cookie=?";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([$cookieid]);
        while($line = $this->db->statement->fetch()){

          $ausgabe .= ($ausgabe=="")?($line["website"]):($trennzeichen . $line["website"]);

        }

        return $ausgabe;

      }

      public function cookieCatShortListing($cookieid, $trennzeichen=",") : string
      {

        $ausgabe="";
        $sql = "SELECT a.name AS category FROM cookie_categories a LEFT JOIN cookies2categories b ON b.category=a.id WHERE a.deleted='0' AND b.cookie=?";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([$cookieid]);
        while($line = $this->db->statement->fetch()){

          $ausgabe .= ($ausgabe=="")?($line["category"]):($trennzeichen . $line["category"]);

        }

        return $ausgabe;

      }

      private function fetchDbElemLines() : void
      {

        while( $this->dbdata[] = $this->db->statement->fetch() ){}

        array_pop( $this->dbdata );
        $this->sql = "";

      }

      private function fetchDbLines() : void
      {

        while( $this->data[] = $this->db->statement->fetch() ){}

        array_pop( $this->data );

      }

      private function executeDb() : void
      {

        $this->db->statement = $this->db->pdo->prepare($this->sql);
        $this->db->statement->execute($this->datain);

      }


  }?>
