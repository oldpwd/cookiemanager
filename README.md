CookieManager 0.2.0

PHP DSGVO CookieManager. Manage cookies and privacy settings for multiple websites by one interface.

CookieManager is released under the GNU Public License, version 3 or later.

http://www.gnu.org/licenses/gpl-3.0-standalone.html


-----------------------------------
Requirements
-----------------------------------
 - PHP >= 7 + curl 
 - Apache mod rewrite
 - MySQL / MariaDB


-----------------------------------
Install
-----------------------------------
 - Create database and import config/sql/cookiemanager.sql to database

 - Add access data for database at config/db.php

 - Open https://[YOURDOMAIN]/cookiemanager/admin

   User: admin

   Password: admin

   CHANGE ADMIN PASSWORD IN "SETTINGS" !!!



-----------------------------------
Aditional settings
-----------------------------------
Language: config/lang.php

Timeouts: config/timeout.php


-----------------------------------
Using
-----------------------------------
1. Setup websites + layouts + cookie-codes in admin

2. Add the cookiemanager js-tag to your website html


-----------------------------------
Example
-----------------------------------
https://www.raistech.de
