<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html
  # Author SL, JUSTilize GmbH, Frankfurt/Main

	namespace Cookiemanager\helper;


	class Router
  {

      private $httpvars;

      private $templatedir = __DIR__ . "/../admin/templates/";

      private $sitepath;

      public $elemdir;

      public $requirefile;

      public $language = "de";

      public $site = ["index"];


      function __construct(&$httpvars)
    	{

        $this->httpvars = $httpvars;

        $this->fetchFolder();

        $this->fetchSite();

        $this->fetchLanguage();

			}

      public function linkIsActive($linkarr) : bool
      {

        if(implode(".", $this->site) !== implode(".", $linkarr)){

          return false;

        }

        return true;

      }

      private function fetchLanguage() : void
      {

        require_once( __DIR__ . "/../../config/lang.php");

        if(is_file( __DIR__ . "/../../config/lang/" . GLOBAL_LANGUAGE . "/index.php")){

          $this->language = GLOBAL_LANGUAGE;

        }

      }

      private function fetchSite() : void
      {

        if(isset($_GET["site"])){

          $this->site = explode("-", preg_replace('/[^a-z\-]/', '', $_GET["site"]));

        }

        foreach($this->site as $wert){

          $this->sitepath .= $wert . '/';

        }

        if(is_file($this->templatedir . $this->sitepath . "/index.php")){

          $this->requirefile = $this->templatedir . $this->sitepath . "/index.php";

        }else{

          if($this->httpvars->loggedin !== false){

            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

            $this->requirefile = $this->templatedir . "notfound/index.php";

          }else{

            $this->requirefile = $this->templatedir . "index/index.php";

          }

        }

      }

      private function fetchFolder() : void
      {

        $this->elemdir = $this->templatedir . "elements/";

        if($this->httpvars->loggedin === true){

          $this->templatedir .= "protected/";

        }else{

          $this->templatedir .= "public/";

        }

      }


  }?>
