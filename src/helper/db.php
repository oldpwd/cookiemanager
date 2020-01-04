<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html



	namespace Cookiemanager\helper;

  use \PDO;


	class Db
  {

			public $pdo;

      public $sql;

      public $statement;

      public $dbdata = [];

      public $datain = [];


      function __construct()
    	{

        require_once( __DIR__ . "/../../config/db.php");

        $this->pdo = new \PDO(

          "mysql:host=" . MYSQL_SERVER . ";dbname=" . MYSQL_DATABASE,
          MYSQL_USERNAME,
          MYSQL_PASSWORD,
          array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")

        );

			}

      public function executeStm() : void
      {

        $this->dbdata = [];
        $this->statement = $this->pdo->prepare($this->sql);
        $this->statement->execute($this->datain);
        $this->dbdata = $this->statement->fetch();

      }

      public function executeMultiStm() : void
      {

        $this->dbdata = [];
        $this->statement = $this->pdo->prepare($this->sql);
        $this->statement->execute($this->datain);

      }


  }?>
