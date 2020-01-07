<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html


	namespace Cookiemanager\helper;


	class CookieSwitcher
  {

      private $db;

      private $init;

      private $allowlevel;


      function __construct(&$db, &$init)
    	{

        $this->db = $db;

        $this->init = $init;

        $this->allowlevel = explode("C", preg_replace('/[^0-9C]/','', $_GET["allowlevel"]));

        $this->clearCookies();

        $this->setCookies();

			}

      private function checkReplacementCall($id) : bool
      {

        foreach($this->allowlevel AS $wert){

          if($wert == $id){

            return false;

          }

        }

        return true;

      }

      private function clearCookies() : void
      {

        $this->db->sql = "";
        $this->db->datain = [];

        foreach($this->init->cookiecodes AS $wert){

          if($this->checkReplacementCall($wert["cookieid"])){

            $this->db->sql .= "DELETE FROM `" . $this->init->opttable . "` WHERE usertoken=? AND websiteid=? AND cookieid=? AND allowlevel='1'; ";
            $this->db->datain[] = $this->init->userid;
            $this->db->datain[] = $this->init->websiteid;
            $this->db->datain[] = $wert["cookieid"];

          }

        }

        if($this->db->sql != ""){

          $this->db->executeMultiStm();

        }

      }

      private function checkCookieCall($id) : bool
      {

        foreach($this->init->cookiecodes AS $wert){

          if($wert["cookieid"] == $id && $wert["useroptin"] == ""){

            return true;

          }

        }

        return false;

      }

      private function setCookies() : void
      {

        $this->db->sql = "";
        $this->db->datain = [];

        foreach($this->allowlevel as $wert){

          if($this->checkCookieCall($wert)){

            $this->db->sql .= "INSERT INTO `" . $this->init->opttable . "` SET usertoken=?, websiteid=?, cookieid=?, zeitpunkt=?, tcpip=?, allowlevel='1'; ";
            $this->db->datain[] = $this->init->userid;
            $this->db->datain[] = $this->init->websiteid;
            $this->db->datain[] = $wert;
            $this->db->datain[] = time();
            $this->db->datain[] = $this->init->tcpiphash;

          }

        }

        if($this->db->sql != ""){

          $this->db->executeMultiStm();

        }

      }

  }?>
