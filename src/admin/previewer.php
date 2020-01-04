<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html
  # Author SL, JUSTilize GmbH, Frankfurt/Main

	namespace Cookiemanager;


	final class Previewer
  {

      private $db;

      private $csrf;

      private $httpvars;

      private $token;

      private $exturl;

      private $exthtml;


      function __construct()
    	{

        require_once( __DIR__ . "/../../config/hostname.php");

        require_once( __DIR__ . "/../../config/timeout.php");

        $this->db = new helper\Db;

        $this->csrf = new helper\Csrf($this->db);

        $this->httpvars = new helper\Httpvars($this->db, $this->csrf->sended);

        if($this->httpvars->loggedin === true){

          if(isset($_GET["token"])){

            if($this->verifyToken( preg_replace('/[^0-9a-f]/','', $_GET["token"]) )){

              if($this->fetchExtUrl() !== 200){

                $this->throwHtml();

              }

              $this->setHtmlElements();
              print $this->exthtml;

            }

          }

        }

      }

      private function setHtmlElements() : void
      {

        $tag1 = '<base href="' . $this->exturl . '/">';
        $tag2 = '<script src="' . str_replace("preview/", "", $this->httpvars->appurl) . $this->token . '/"></script>';
        $tag3 = '<script>let COM_anchors=document.getElementsByTagName("a");for(i=0, len=COM_anchors.length; i<len; i++){COM_anchors[i].addEventListener("click", function(e){e.preventDefault();});}</script><a href="'. str_replace("preview/", "admin/", $this->httpvars->appurl) .'preview/' . $this->token . '/" target="_blank" style="position:fixed;top:0px;right:0px;display:inline-block;font-size:1em;z-index:999999;color:#FFF;border-bottom-left-radius:12px;background:#444;opacity:0.8;padding:15px;">&raquo; Open preview as new window</a>';

        $this->exthtml = str_replace($tag2, '', $this->exthtml);
        $this->exthtml = str_replace("<head>", "<head>\n" . $tag1, $this->exthtml);
        $this->exthtml = str_replace("</body>", $tag3 . $tag2 . "\n</body>", $this->exthtml);

      }

      private function verifyToken($token) : bool
      {

        $sql = "SELECT id, host, token FROM cookie_websites WHERE token=?";
        $this->db->statement = $this->db->pdo->prepare($sql);
        $this->db->statement->execute([$token]);
        $this->db->dbdata = $this->db->statement->fetch();

        if($this->db->dbdata["id"] != ""){

          $this->token = $this->db->dbdata["token"];
          $this->exturl = "https://" . $this->db->dbdata["host"];
          return true;

        }

        return false;

      }

      private function fetchExtUrl() : int
      {


        $options = [

            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_POST           => false,
            CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/71.0",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT        => 120,
            CURLOPT_MAXREDIRS      => 10
        ];

        $ch = curl_init( $this->exturl );
        curl_setopt_array( $ch, $options );
        $this->exthtml = curl_exec( $ch );
        $err = curl_errno( $ch );
        $errmsg = curl_error( $ch );
        $header = curl_getinfo( $ch );
        curl_close( $ch );

        return $header["http_code"];

      }

      private function throwHtml() : void
      {

        $this->exthtml = '<!doctype html>
        <html dir="ltr" lang="de">
          <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="'. str_replace("preview/", "admin/", $this->httpvars->appurl) .'css/bootstrap.min.css">
            <title>CookieManager Preview</title>
          </head>
          <body style="background:#f2f2f2;">
              <h1 class="text-center">CookieManager Preview</h1>
              <br><br>
            <script src="'. str_replace("preview/", "admin/", $this->httpvars->appurl) .'js/jquery.min.js"></script>
            <script src="'. str_replace("preview/", "admin/", $this->httpvars->appurl) .'js/bootstrap.min.js"></script>
          </body>
        </html>

        ';

      }


  }?>
