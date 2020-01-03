<?php
error_reporting(-1);

# CookieManager is released under the GNU Public License, version 3 or later.
# http://www.gnu.org/licenses/gpl-3.0-standalone.html
# Author SL, Raistech GmbH

header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once( __DIR__ . "/src/helper/db.php");
require_once( __DIR__ . "/src/helper/httpvars.php");
require_once( __DIR__ . "/src/helper/cminit.php");
require_once( __DIR__ . "/src/helper/cookieswitcher.php");
require_once( __DIR__ . "/src/helper/jstemplates.php");
require_once( __DIR__ . "/src/helper/objects/webobject.php");
require_once( __DIR__ . "/src/cookiemanager.php");

new Cookiemanager\Cookiemanager;

 ?>
