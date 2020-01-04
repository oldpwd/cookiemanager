<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html



	namespace Cookiemanager\helper;


	class Csrf
  {

      private $db;

      private $csrftoken;

      public $sended;


      function __construct(&$db)
    	{

        $this->db = $db;

        $this->cleanTables();

        if(isset($_POST["token"])){

          $this->csrftoken = preg_replace('/[^a-f0-9]/', '', $_POST["token"]);
          $this->checkToken();

        }

			}

      private function checkToken() : bool
      {

        $sql = "SELECT csrftoken, sended FROM csrftoken WHERE sessionid=? AND csrftoken=?";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([session_id(), $this->csrftoken]);
        $this->db->dbdata = $this->db->statement->fetch();

        if( $this->db->dbdata["csrftoken"] === $this->csrftoken ){

          $this->sended = $this->db->dbdata["sended"];

          $sql = "DELETE FROM csrftoken WHERE sessionid=? AND sended=?";
          $this->db->statement = $this->db->pdo->prepare($sql);
          $this->db->statement->execute([session_id(), $this->sended]);

          return true;

        }

        return false;

      }

      public function genToken($sended) : string
      {

        $token = bin2hex(random_bytes(32));

        $sql = "DELETE FROM csrftoken WHERE sessionid=? AND sended=?";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([session_id(), $sended]);

        $sql = "INSERT INTO csrftoken SET sessionid=?, csrftoken=?, sended=?, zeitpunkt=?";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([session_id(), $token, $sended, time()]);

        return $token;

      }

      private function cleanTables() : void
      {

        $sql = "DELETE FROM csrftoken WHERE zeitpunkt < ?";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([time() - 86400]);

        $sql = "DELETE FROM login WHERE zeitpunkt < ?";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([time() - GLOBAL_TIMEOUT]);

      }

  }?>
