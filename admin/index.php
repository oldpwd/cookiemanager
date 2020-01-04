<?php

error_reporting(-1);
session_start();

# CookieManager is released under the GNU Public License, version 3 or later.
# http://www.gnu.org/licenses/gpl-3.0-standalone.html


require_once( __DIR__ . "/../src/helper/db.php");
require_once( __DIR__ . "/../src/helper/csrf.php");
require_once( __DIR__ . "/../src/helper/httpvars.php");
require_once( __DIR__ . "/../src/helper/formhandle.php");
require_once( __DIR__ . "/../src/helper/routing.php");
require_once( __DIR__ . "/../src/helper/objects/dbobjects.php");
require_once( __DIR__ . "/../src/helper/sitedata.php");
require_once( __DIR__ . "/../src/helper/siteelements.php");
require_once( __DIR__ . "/../src/admin/admin.php");

new Cookiemanager\Admin;


 ?>
