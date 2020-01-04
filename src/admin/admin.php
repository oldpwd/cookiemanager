<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html


	namespace Cookiemanager;


	final class Admin
  {

      private $db;

      private $csrf;

      private $httpvars;

      private $formhandle;

      private $router;

      private $sitedata;


      function __construct()
    	{

        require_once( __DIR__ . "/../../config/hostname.php");

        require_once( __DIR__ . "/../../config/timeout.php");

        $this->db = new helper\Db;

        $this->csrf = new helper\Csrf($this->db);

        $this->httpvars = new helper\Httpvars($this->db, $this->csrf->sended);

        if($this->httpvars->loggedin === true && $this->csrf->sended != ""){

          if($this->csrf->sended !== "login"){

            $this->formhandle = new helper\Formhandle($this->db, $this->csrf->sended);

          }

        }

        $this->router = new helper\Router($this->httpvars);

        if($this->httpvars->loggedin === true){

          $this->sitedata = new helper\Sitedata($this->db, $this->router->site);
          $this->siteelem = new helper\Siteelements($this->sitedata, $this->httpvars);

        }

        $this->httpvars->setLanguage($this->router->language);

        if($this->httpvars->adminbadpassword){

          $this->httpvars->errorm = $this->httpvars->language["ADMIN_BADPW_MSG"];

        }

        if(isset($this->formhandle)){

          if($this->formhandle->errorpointer != ""){

            $this->formhandle->errorm = $this->httpvars->language[$this->formhandle->errorpointer];

          }

        }

        $this->parseHtmlOutput();

			}

      private function parseHtmlOutput() : void
      {

        require_once( __DIR__ . "/templates/index.php");

      }



  }?>
