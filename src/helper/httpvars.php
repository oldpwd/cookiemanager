<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html
  # Author SL, JUSTilize GmbH, Frankfurt/Main

	namespace Cookiemanager\helper;


	class Httpvars
  {

      private $db;

      public $adminbadpassword = false;

      public $adminpasswordstddbhash = '$2y$10$p0og/eWKFn1und4nPZ1eoeGhm1o2mZo8PHZLqgnzKWdMbuSpDg.Y.';

      public $sended;

      public $baseurl;

      public $appurl;

      public $datum;

      public $uhrzeit;

      public $tcpip;

      public $loggedin;

      public $userid;

      public $username;

      public $useremail;

      public $errorm;

      public $language;


      function __construct(&$db, &$sended="")
    	{

        $this->db = $db;
        $this->fetchBaseUrl();
        $this->fetchAppUrl();
        $this->datum = date("Ymd");
        $this->uhrzeit = date("His");
        $this->tcpip = $_SERVER["REMOTE_ADDR"];
        $this->sended = $sended;

        if($sended === "login"){

          if($this->loginUser() === false){

            $this->errorm = "Login failed!";

          }

        }

        if($sended === "logout"){

          $this->logoutUser();

        }

        $this->loggedin = $this->fetchUserStatus();

			}

      public function setLanguage($language) : void
      {

        require_once( __DIR__ . "/../../config/lang/" . $language . "/index.php");

        $this->language = $langElements;

      }

      private function fetchUserStatus() : bool
      {

        $sql = "SELECT a.userid AS userid, b.username AS username, b.email AS useremail FROM login a LEFT JOIN
                user b ON b.id = a.userid WHERE a.sessionid=? AND b.active='1'";

        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([session_id()]);
        $this->db->dbdata = $this->db->statement->fetch();

        if($this->db->dbdata["userid"] != ""){

          $this->userid = $this->db->dbdata["userid"];
          $this->username = $this->db->dbdata["username"];
          $this->useremail = $this->db->dbdata["useremail"];

          $sql = "UPDATE login SET zeitpunkt=? WHERE sessionid=?";
          $this->db->statement = $this->db->pdo->prepare($sql);
          $this->db->statement->execute([time(), session_id()]);

          return true;

        }

        return false;

      }

      private function loginUser() : bool
      {

        $sql = "SELECT id, pwhash, username FROM user WHERE username=? AND active='1'";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([ preg_replace('/[^a-zA-Z0-9]/', '', $_POST["benutzername"]) ]);
        $this->db->dbdata = $this->db->statement->fetch();

        if($this->db->dbdata["id"] != ""){

          $userid = $this->db->dbdata["id"];
          $pwhash = $this->db->dbdata["pwhash"];
          $username = $this->db->dbdata["username"];
          $bruteforceid = "";

          $sql = "SELECT id, counter FROM bruteforce WHERE userid=? AND zeitpunkt > ?";
          $this->db->statement = $this->db->pdo->prepare($sql);
          $this->db->statement->execute([$userid, time() - BRUTEFORCE_TIMEOUT]);
          $this->db->dbdata = $this->db->statement->fetch();

          if($this->db->dbdata["id"] != ""){

            if($this->db->dbdata["counter"] > 4){

              return false;

            }

            $bruteforceid = $this->db->dbdata["id"];

          }

          if(password_verify($_POST["passwort"], $pwhash)){

            if($_POST["passwort"] === "admin"){

              $this->adminbadpassword = true;

            }

            $sql = "DELETE FROM login WHERE userid=? OR sessionid=?;
                    INSERT INTO login SET sessionid=?, userid=?, zeitpunkt=?;
                    INSERT INTO loginlog SET datum=?, uhrzeit=?, tcpip=?, sessionid=?, userid=?
            ";

            $this->db->statement = $this->db->pdo->prepare($sql);
            $this->db->statement->execute([

                                              $userid,
                                              session_id(),
                                              session_id(),
                                              $userid,
                                              time(),
                                              $this->datum,
                                              $this->uhrzeit,
                                              $_SERVER["REMOTE_ADDR"],
                                              session_id(),
                                              $userid

                                          ]);

            return true;

          }

          if($bruteforceid != ""){

            $sql = "UPDATE bruteforce SET userid=?, counter=(counter+1), zeitpunkt=? WHERE id=?";
            $this->db->statement = $this->db->pdo->prepare($sql);
            $this->db->statement->execute([$userid, time(), $bruteforceid]);

            return false;

          }

          $sql = "INSERT INTO bruteforce SET userid=?, counter='1', zeitpunkt=?";
          $this->db->statement = $this->db->pdo->prepare($sql);
          $this->db->statement->execute([$userid, time()]);

          return false;

        }

        return false;

      }

      private function logoutUser() : void
      {

        $sql = "DELETE FROM csrftoken WHERE sessionid=?; DELETE FROM login WHERE sessionid=?";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([session_id(), session_id()]);
        session_regenerate_id();

      }

      private function fetchAppUrl() : void
      {

        $this->appurl = str_replace('/admin', '', $this->baseurl);

      }

      private function fetchBaseUrl() : void
      {

        if( GLOBAL_BASE_URL != "" ){

          $this->baseurl = GLOBAL_BASE_URL;

        }else{

          $this->baseurl = ($_SERVER['HTTPS']=="on")?("https://"):("http://");

          $this->baseurl .= htmlspecialchars($_SERVER['SERVER_NAME']);

        }

        $this->baseurl .= str_replace(

          $_SERVER['DOCUMENT_ROOT'],
          '',
          preg_replace('/(.*\/)(.*)/', '${1}', $_SERVER['SCRIPT_FILENAME'])

        );

      }


  }?>
