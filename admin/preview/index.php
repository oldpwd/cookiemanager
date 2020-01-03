<?php

error_reporting(-1);
session_start();

# CookieManager is released under the GNU Public License, version 3 or later.
# http://www.gnu.org/licenses/gpl-3.0-standalone.html
# Author SL, JUSTilize GmbH, Frankfurt/Main

require_once( __DIR__ . "/../../src/helper/db.php");
require_once( __DIR__ . "/../../src/helper/csrf.php");
require_once( __DIR__ . "/../../src/helper/httpvars.php");
require_once( __DIR__ . "/../../src/admin/previewer.php");

new Cookiemanager\Previewer;

?>
