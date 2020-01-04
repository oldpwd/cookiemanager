<?php

# CookieManager is released under the GNU Public License, version 3 or later.
# http://www.gnu.org/licenses/gpl-3.0-standalone.html


#SET INACTIVE TIMEOUT FOR LOGIN-SESSIONS, DEFAULT 1800 SECONDS = 30 MINUTES
define("GLOBAL_TIMEOUT", 1800);

#BRUTEFORCE CHROOT TIMEOUT, DEFAULT 600 SECONDS = 10 MINUTES
define("BRUTEFORCE_TIMEOUT", 600);

#COOKIEMANAGER IP-BLOCK TIMEOUT, DEFAULT 60 SECONDS
define("IPTIMEOUT", 60);

#COOKIEMANAGER NUMBER OF MAXIMUM REGISTRATIONS DURING IPTIMEOUT , DEFAULT 10
define("IPMAXREGS", 10);

 ?>
