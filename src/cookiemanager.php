<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html
  # Author SL, JUSTilize GmbH, Frankfurt/Main

	namespace Cookiemanager;


	final class Cookiemanager
  {

      private $db;

      private $init;

      private $token;

      private $jstemplate;

      private $webobject;

      private $httpvars;



      function __construct()
    	{

        if(isset($_GET["token"])){

          require_once( __DIR__ . "/../config/hostname.php");

          require_once( __DIR__ . "/../config/timeout.php");

          $this->db = new helper\Db;

          $this->httpvars = new helper\Httpvars($this->db);

          $this->token = preg_replace('/[^a-f0-9]/','', $_GET["token"]);

          $this->init = new helper\CmInit($this->db);

          if($this->init->init($this->token)){

            $this->init->fetchCookieCodes();

            if($this->init->loggedin){

              header("Content-Type: application/json; charset=utf-8");

              new helper\CookieSwitcher($this->db, $this->init);

              if(!isset($_GET["switch"])){

                new helper\objects\WebObject($this->init, $this->db, $this->httpvars);

              }

            }else{

              header("Content-Type: application/javascript; charset=utf-8");

              new helper\JsTemplate($this->init, $this->httpvars);

            }

          }else{

            $this->throwError();

          }

        }else{

          $this->throwError();

        }

			}

      private function throwError() : void
      {

        print "console.log('CookieManager: unvalid token');\n";

      }


  }?>
