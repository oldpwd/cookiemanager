<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html


	namespace Cookiemanager\helper;


	class Formhandle
  {

			private $db;

      private $sql;

      private $datain;

      private $dbdata;

      private $websiteid;

      private $sended;

      private $givenpw;

      public $cookieid = "0";

      public $success;

      public $errorm;

      public $errorpointer = "";


      function __construct(&$db, &$sended)
    	{

        $this->db = $db;

        $this->sended = $sended;

        if($this->sended === "companyedit" || $this->sended === "companycreate"){

          $this->dbCompany();

        }
        if($this->sended === "companydelete" && $_POST["id"] != "1"){

          $this->datain = [ $_POST["id"] ];
          $this->dbDelete("cookie_companies");
          unset( $_POST["id"] );

        }
        if($this->sended === "categoryedit" || $this->sended === "categorycreate"){

          $this->dbCategory();

        }
        if($this->sended === "categorydelete" && $_POST["id"] != "1"){

          $this->datain = [ $_POST["id"] ];
          $this->dbDelete("cookie_categories");
          unset( $_POST["id"] );

        }
        if($this->sended === "categoryoff" && $_POST["id"] != "1"){

          $this->datain = [ $_POST["id"] ];
          $this->dbOff("cookie_categories");

        }
        if($this->sended === "categoryon"){

          $this->datain = [ $_POST["id"] ];
          $this->dbOn("cookie_categories");

        }
        if($this->sended === "useredit" || $this->sended === "usercreate"){

          $this->dbUser();

        }
        if($this->sended === "useroff" && $_POST["id"] != "1"){

          $this->datain = [ $_POST["id"] ];
          $this->dbOff("user");

        }
        if($this->sended === "useron"){

          $this->datain = [ $_POST["id"] ];
          $this->dbOn("user");

        }
        if($this->sended === "cookieedit" || $this->sended === "cookiecreate"){

          $this->dbCookie();

        }
        if($this->sended === "cookiedelete" && $_POST["id"] != "1"){

          $this->datain = [ $_POST["id"] ];
          $this->dbDelete("cookies");
          unset( $_POST["id"] );

        }
        if($this->sended === "cookieoff" && $_POST["id"] != "1"){

          $this->datain = [ $_POST["id"] ];
          $this->dbOff("cookies");

        }
        if($this->sended === "cookieon"){

          $this->datain = [ $_POST["id"] ];
          $this->dbOn("cookies");

        }
        if($this->sended === "cookiestowebsite"){

          $this->cookiesToWebsites();

        }
        if($this->sended === "cookiebarupdate" || $this->sended === "cookieboxupdate"){

          $this->cookieBUpdate( str_replace('update', '', $this->sended) );

        }
        if($this->sended === "websitenew"){

          if($this->dbWebsiteNew()){

            $this->dbWebsiteSetup('cookiebar_vars','cookiebars');
            $this->dbWebsiteSetup('cookiebox_vars','cookieboxes');

          }
          $this->sql = "";

        }
        if($this->sended === "websiteupdate"){

          $this->datain = [ htmlspecialchars($_POST["hostname"]), htmlspecialchars($_POST["hostname"]), $_POST["id"] ];
          $this->dbWebsiteUpdate();

        }
        if($this->sended === "websitedelete"){

          $this->datain = [ $_POST["id"] ];
          $this->dbDelete("cookie_websites");
          unset( $_POST["id"] );

        }
        if($this->sended === "websiteoff"){

          $this->datain = [ $_POST["id"] ];
          $this->dbOff("cookie_websites");

        }
        if($this->sended === "websiteon"){

          $this->datain = [ $_POST["id"] ];
          $this->dbOn("cookie_websites");

        }

        if($this->sql != ""){

          $this->db->statement = $this->db->pdo->prepare($this->sql);
          $this->db->statement->execute($this->datain);

        }

      }

      private function dbCompany() : void
      {

          $this->sql = ($this->sended === "companyedit")?("UPDATE "):("INSERT INTO ");
          $this->sql .= "cookie_companies SET name=?, strasse=?, ort=?, land=?, url=?, impressum=?, datenschutz=?";
          $this->datain = [htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["strasse"]), htmlspecialchars($_POST["ort"]), htmlspecialchars($_POST["land"]), htmlspecialchars($_POST["url"]), htmlspecialchars($_POST["impressum"]), htmlspecialchars($_POST["datenschutz"])];

          if($this->sended === "companyedit"){

            $this->sql .= " WHERE id=?";
            $this->datain[] = $_POST["id"];

          }

      }

      private function dbCategory() : void
      {

          $this->sql = ($this->sended === "categoryedit")?("UPDATE "):("INSERT INTO ");
          $this->sql .= "cookie_categories SET name=?, description=?";
          $this->datain = [htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["description"])];

          if($this->sended === "categoryedit"){

            $this->sql .= " WHERE id=?";
            $this->datain[] = $_POST["id"];

          }

      }

      private function checkUserData() : bool
      {

        if($_POST["pass1"] != "" || $_POST["pass2"] != ""){

          if(strlen($_POST["pass1"]) < 8){ $this->errorpointer = "USER_SHORTPW"; return false; }
          if($_POST["pass1"] !== $_POST["pass2"]){ $this->errorpointer = "USER_UQUALPW"; return false; }
          $this->givenpw = password_hash($_POST["pass1"], PASSWORD_DEFAULT);

        }

        if($this->sended === "usercreate"){

          $sql = "SELECT id FROM user WHERE username=?";
          $this->db->statement = $this->db->pdo->prepare($sql);
          $this->db->statement->execute([preg_replace('/[^a-z0-9]/', '', $_POST["username"])]);
          $this->dbdata = $this->db->statement->fetch();
          if($this->dbdata["id"]){ $this->errorpointer = "USER_NIQNAME"; return false; }
          if(strlen(preg_replace('/[^a-z0-9]/', '', $_POST["username"])) < 4){ $this->errorpointer = "USER_SHORTNAME"; return false; }

        }

        return true;

      }

      private function dbUser() : void
      {

        if($this->checkUserData()){

          $this->sql = ($this->sended === "useredit")?("UPDATE "):("INSERT INTO ");
          $this->sql .= "user SET email=?";
          $this->datain = [htmlspecialchars($_POST["email"])];

          if($this->givenpw){

            $this->sql.= ", pwhash=?";
            $this->datain[] = $this->givenpw;

          }

          if($this->sended === "usercreate"){

            $this->sql.= ", username=?, name=?";
            $this->datain[] = preg_replace('/[^a-z0-9]/', '', $_POST["username"]);
            $this->datain[] = preg_replace('/[^a-z0-9]/', '', $_POST["username"]);

          }else{

            $this->sql .= " WHERE id=?";
            $this->datain[] = $_POST["id"];
            $this->success = "Aktion erfolgreich!";

          }

        }

      }

      private function dbCookie() : void
      {

        $this->sql = ($this->sended === "cookieedit")?("UPDATE "):("INSERT INTO ");
        $this->sql .= "cookies SET name=?, internalremarks=?, company=?, beschreibung=?, personenbezogenedaten=?, landderdatenerfassung=?, wirdgeloeschtnach=?, sourcecode=?";
        $this->datain = [htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["internalremarks"]), htmlspecialchars($_POST["company"]), htmlspecialchars($_POST["beschreibung"]), htmlspecialchars($_POST["personenbezogenedaten"]), htmlspecialchars($_POST["landderdatenerfassung"]), htmlspecialchars($_POST["wirdgeloeschtnach"]), htmlspecialchars($_POST["sourcecode"], ENT_NOQUOTES)];

        if($this->sended === "cookieedit"){

          if($_POST["id"] !== "1"){

            $this->cookieid = $_POST["id"];
            $this->sql .= ", sourcetype=?";
            $this->datain[] = htmlspecialchars($_POST["sourcetype"]);

          }

          $this->sql .= " WHERE id=?";
          $this->datain[] = $_POST["id"];

        }else{

          $this->sql .= ", sourcetype=?";
          $this->datain[] = htmlspecialchars($_POST["sourcetype"]);

        }

        $this->db->statement = $this->db->pdo->prepare($this->sql);
        $this->db->statement->execute($this->datain);
        $this->sql = "";

        if($this->sended === "cookiecreate"){

          $this->cookieid = $this->db->pdo->lastInsertId();

        }

        if($this->cookieid != "0"){

          $this->sql = "";
          $this->datain = [];

          $this->sql = "DELETE FROM cookies2websites WHERE cookie=?; ";
          $this->datain = [$this->cookieid];

          if(isset($_POST["websites"])){

            foreach($_POST["websites"] as $wert){

              $this->sql .= "INSERT INTO cookies2websites SET website=?, cookie=?; ";
              $this->datain[] = $wert;
              $this->datain[] = $this->cookieid;

            }

          }

          $this->sql .= "DELETE FROM cookies2categories WHERE cookie=?; ";
          $this->datain[] = $this->cookieid;
          $this->sql .= "INSERT INTO cookies2categories SET category=?, cookie=?; ";
          $this->datain[] = $_POST["category"];
          $this->datain[] = $this->cookieid;

        }

      }

      private function cookiesToWebsites() : void
      {

        $this->sql = "DELETE FROM cookies2websites WHERE website=? AND cookie!='1'; ";
        $this->datain = [$_POST["id"]];

        if(isset($_POST["cookieids"])){

          foreach($_POST["cookieids"] as $wert){

            if($wert != "1"){

              $this->sql .= "INSERT INTO cookies2websites SET cookie=?, website=?; ";
              $this->datain[] = $wert;
              $this->datain[] = $_POST["id"];

            }

          }

        }

      }

      private function cookieBUpdate($what) : void
      {

        $sourcetable = $what . "_vars";
        $targettable = ($what == "cookiebar")?($what . "s"):($what . "es");

        $this->sql = "SELECT id, varname, defaultval FROM " . $sourcetable;
        $this->db->statement = $this->db->pdo->prepare($this->sql);
        $this->db->statement->execute([]);
        $this->sql = "";
        $this->datain = [];

        while($this->dbdata = $this->db->statement->fetch()){

          if(isset($_POST[$this->dbdata["varname"]])){

            $this->sql .= "UPDATE " . $targettable . " SET value=? WHERE websiteid=? AND varid=?; ";
            $this->datain[] = htmlspecialchars($_POST[$this->dbdata["varname"]]);


          }else{

            $this->sql .= "INSERT INTO " . $targettable . " SET value=?, websiteid=?, varid=?; ";
            $this->datain[] = $this->dbdata["defaultval"];

          }

          $this->datain[] = $_POST["id"];
          $this->datain[] = $this->dbdata["id"];

        }

      }

      private function dbWebsiteSetup($tabelleout, $tabellein) : void
      {

        $this->sql = "SELECT id, defaultval FROM " . $tabelleout;
        $this->db->statement = $this->db->pdo->prepare($this->sql);
        $this->db->statement->execute([]);
        $this->sql = "";
        $this->datain = [];

        while($this->dbdata = $this->db->statement->fetch()){

          $this->sql .= "INSERT INTO " . $tabellein . " SET websiteid=?, varid=?, value=?; ";
          $this->datain[] = $this->websiteid;
          $this->datain[] = $this->dbdata["id"];
          $this->datain[] = $this->dbdata["defaultval"];

        }

        $this->db->statement = $this->db->pdo->prepare($this->sql);
        $this->db->statement->execute($this->datain);

      }

      private function dbWebsiteNew() : bool
      {

        $token = bin2hex(random_bytes(32));
        $this->sql = "SELECT id FROM cookie_websites WHERE token=?";
        $this->db->statement = $this->db->pdo->prepare($this->sql);
        $this->db->statement->execute([$token]);
        $this->dbdata = $this->db->statement->fetch();

        if($this->dbdata["id"] > 0){

          $this->errorm = "Couldnt create valid token!";
          return false;

        }

        $this->sql = "INSERT INTO cookie_websites SET host=?, name=?, token=?";
        $this->db->statement = $this->db->pdo->prepare($this->sql);
        $this->db->statement->execute([htmlspecialchars($_POST["domain"]), htmlspecialchars($_POST["domain"]), $token]);
        $this->websiteid = $this->db->pdo->lastInsertId();
        $this->sql = "INSERT INTO cookies2websites SET cookie='1', website=?";
        $this->db->statement = $this->db->pdo->prepare($this->sql);
        $this->db->statement->execute([$this->websiteid]);
        return true;

      }

      private function dbWebsiteUpdate() : void
      {

        $this->sql = "UPDATE cookie_websites SET host=?, name=? WHERE id=?";

      }

      private function dbDelete($table) : void
      {

        $this->sql = "UPDATE " . $table . " SET deleted='1' WHERE id=?";

      }

      private function dbOn($table) : void
      {

        $this->sql = "UPDATE " . $table . " SET active='1' WHERE id=?";

      }

      private function dbOff($table) : void
      {

        $this->sql = "UPDATE " . $table . " SET active='0' WHERE id=?";

      }

  }?>
