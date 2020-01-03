<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html
  # Author SL, JUSTilize GmbH, Frankfurt/Main

	namespace Cookiemanager\helper\objects;


	class DbObject
  {

      public $tablemap = [];

      public $id = "";

      function __construct()
    	{

        $this->tablemap["websites"] = "cookie_websites";
        $this->tablemap["cookies"] = "cookies";
        $this->tablemap["categories"] = "cookie_categories";
        $this->tablemap["companies"] = "cookie_companies";
        $this->tablemap["settings"] = "user";


			}

  }?>
