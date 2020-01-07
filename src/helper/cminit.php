<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html


	namespace Cookiemanager\helper;


	class CmInit
  {

    private $db;

    private $iptimeout = IPTIMEOUT;

    private $ipmaxactions = IPMAXREGS;

    public $tcpiphash;

    public $websiteid;

    public $webhost;

    public $userid;

    public $loggedin = false;

    public $regdate;

    public $opttable;

    public $cookiecodes = [];


      function __construct(&$db)
    	{

        $this->db = $db;

        $this->tcpiphash = hash('sha1', $_SERVER["REMOTE_ADDR"]);

			}

      public function fetchAllowLevel($i=0) : void
      {

        foreach($this->cookiecodes AS $wert){

          $this->db->sql = "SELECT zeitpunkt FROM `" . $this->opttable . "` WHERE websiteid=? AND cookieid=? AND usertoken=? AND allowlevel='1'";
          $this->db->datain = [$this->websiteid, $wert["cookieid"], $this->userid];
          $this->db->executeStm();
          $this->cookiecodes[$i]["useroptin"] = ($this->db->dbdata["zeitpunkt"] != "")?($this->db->dbdata["zeitpunkt"]):("");
          $i++;

        }

      }

      public function fetchCookieCodes() : void
      {

        $this->db->sql = " SELECT

                            a.id AS cookieid,
                            a.sourcetype AS sourcetype,
                            a.sourcecode AS sourcecode

                            FROM cookies a
                            LEFT JOIN cookies2websites b ON b.cookie = a.id
                            LEFT JOIN cookie_websites c ON c.id = b.website
                            LEFT JOIN cookies2categories d ON d.cookie = a.id

                           WHERE (a.active='1' AND a.deleted='0') AND (c.active='1' AND c.deleted='0') AND c.id=? AND d.category > 1
        ";

        $this->db->datain = [$this->websiteid];
        $this->db->executeMultiStm();

        while($line = $this->db->statement->fetch()){

          $this->cookiecodes[] = [

            'cookieid' => $line["cookieid"],
            'sourcetype' => $line["sourcetype"],
            'sourcecode' => htmlspecialchars_decode($line["sourcecode"]),
            'useroptin' => ''

          ];

        }

        if($this->loggedin){

          $this->fetchAllowLevel();

        }

      }

      private function checkIpActions() : bool
      {

        $this->db->sql = "SELECT COUNT(allowlevel) AS anzahl FROM `" . $this->opttable . "` WHERE tcpip=? AND allowlevel='8' AND zeitpunkt > ?";
        $this->db->datain = [$this->tcpiphash, (time() - $this->iptimeout)];
        $this->db->executeStm();
        if($this->db->dbdata["anzahl"] < $this->ipmaxactions){

          return true;

        }

        return false;

      }

      private function setUserId() : void
      {

        $seccnt = 0;

        if(isset($_GET["userid"])){

          $this->userid = preg_replace('/[^a-f0-9]/','', substr($_GET["userid"], 0, 32));
          $this->setOptTable();

          if($this->checkLogin() === false){

            if($this->checkIpActions()){

              $this->db->sql = "INSERT INTO `" . $this->opttable . "` SET usertoken=?, websiteid=?, zeitpunkt=?, tcpip=?, allowlevel='8'";
              $this->db->datain = [$this->userid, $this->websiteid, time(), $this->tcpiphash];
              $this->db->executeStm();
              $this->checkLogin();

            }

          }

        }else{

          $this->userid = bin2hex(random_bytes(16));
          $this->setOptTable();

          while($this->checkLogin() && ($seccnt < 10)){

            $this->userid = bin2hex(random_bytes(16));
            $this->setOptTable();

            $seccnt++;

          }

        }

      }

      private function checkLogin() : bool
      {

        $this->db->sql = "SELECT zeitpunkt FROM `" . $this->opttable . "` WHERE (usertoken=? AND websiteid=?) AND allowlevel='8'";
        $this->db->datain = [$this->userid, $this->websiteid];
        $this->db->executeStm();
        if($this->db->dbdata["zeitpunkt"] != "" && (strlen($this->userid) === 32)){

          $this->loggedin = true;
          $this->regdate = (int)$this->db->dbdata["zeitpunkt"];
          return true;

        }

        return false;

      }

      private function setOptTable() : void
      {

        $this->opttable = "opt_chain_" . strtoupper(substr($this->userid, 0, 1));

      }

      public function init($token) : bool
      {

        $this->db->sql = "SELECT id, host FROM cookie_websites WHERE token=? AND (active='1' AND deleted='0')";
        $this->db->datain = [$token];
        $this->db->executeStm();

        $this->websiteid = ($this->db->dbdata["id"] != "")?((int)$this->db->dbdata["id"]):(0);
        $this->webhost = $this->db->dbdata["host"];

        if($this->websiteid > 0){

          $this->setUserId();
          return true;

        }

        return false;

      }

  }?>
