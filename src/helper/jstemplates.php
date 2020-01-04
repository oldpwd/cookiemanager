<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html
  # Author SL, JUSTilize GmbH, Frankfurt/Main

	namespace Cookiemanager\helper;


	class JsTemplate
  {

    private $templatedir = __DIR__ . "/../../config/templates/";

    private $init;

    private $httpvars;

    public $jsoutput;


      function __construct(&$init, &$httpvars)
    	{

        $this->init = $init;

        $this->httpvars = $httpvars;

        $this->jsoutput = file_get_contents($this->templatedir . "jsheader.txt");
        $this->jsoutput .= file_get_contents($this->templatedir . "cookielib.txt");
        $this->jsFunctions();
        $this->cookieBar();
        $this->cookieBox();
        $this->jsBottom();


			}

      function __destruct()
      {

        //print preg_replace('/[\r\n\t]/', '', $this->jsoutput);
        print $this->jsoutput;

      }

      private function htmlCookies() : string
      {

        $ret = "";

        foreach($this->init->cookiecodes as $wert){

          if($wert["sourcetype"] == "2"){

            $ret .= "if(isThrowable('" . $wert["cookieid"] . "')){\n";
              $ret .= "cookieManagerHTMLCookies = cookieManagerHTMLCookies + `" . $wert["sourcecode"] . "`;\n";
              $ret .= "}\n";

          }

        }

        return $ret;

      }

      private function jsCookies() : string
      {

        $ret = "";

        foreach($this->init->cookiecodes as $wert){

          if($wert["sourcetype"] == "3"){

            $ret .= "if(isThrowable('" . $wert["cookieid"] . "')){\n";
              $ret .= $wert["sourcecode"] . "\n";
              $ret .= "}\n";

          }

        }

        return $ret;

      }

      private function cookieBox() : void
      {

        $this->jsoutput .= "for(var cat in cookieManager.categories){\n";
          $this->jsoutput .= "cookieManagerCookies = '', cooZ = 1;\n";
          $this->jsoutput .= "for(var cookie in cookieManager.categories[cat].cookies){\n";
            $this->jsoutput .= "cookieManagerCookies = cookieManagerCookies + `" . file_get_contents($this->templatedir . "cookieboxcookie.txt") . "`;\n";
          $this->jsoutput .= "cooZ++;}\n";
        $this->jsoutput .= "cookieManagerCategories = cookieManagerCategories + `" . file_get_contents($this->templatedir . "cookieboxcategory.txt") . "`;\n";
        $this->jsoutput .= "catZ++;}\n";
        $this->jsoutput .=  "\ncookieManagerAusgabe = cookieManagerAusgabe + `" . file_get_contents($this->templatedir . "cookiebox.txt") . "`;\n";

      }

      private function cookieBar() : void
      {

        $this->jsoutput .=  "\ncookieManagerAusgabe = cookieManagerAusgabe + `" . file_get_contents($this->templatedir . "cookiebar.txt") . "`;\n";

      }

      private function jsFunctions() : void
      {

        $this->jsoutput .= "

  let cookieManagerTemplate = document.createElement('template');
  let cookieManagerCookies = '', cookieManagerCategories = '', catZ = 1, cooZ = 1;
  let cookieManagerAusgabe = '';
  let cookieManagerHTMLCookies = '';
  let cookieManagerToken = '" . $_GET["token"] . "';
  let cookieManagerUserid = (docCookies.getItem(\"cookieManagerUserid\") !== null)?(docCookies.getItem(\"cookieManagerUserid\")):('" . $this->init->userid . "');
  if(docCookies.getItem(\"cookieManagerAllowLevel\") === null){ docCookies.setItem(\"cookieManagerAllowLevel\", \"0\", Infinity, \"/\"); }
  let cookieManagerAllowLevel = docCookies.getItem(\"cookieManagerAllowLevel\");
  let cookieManagerCallUrl = '" . $this->httpvars->appurl . "' + cookieManagerToken + '/' + cookieManagerUserid + '/';
  let cookieManagerAppUrl = '" . $this->httpvars->appurl . "' + cookieManagerToken + '/' + cookieManagerUserid + '/' + cookieManagerAllowLevel  + '/';

  const isThrowable = (num) => {

    var arr = cookieManagerAllowLevel.split('C');
    for(var i = 0; i < arr.length; i++) {

      if(arr[i] == num){

        return true;

      }

    }

    return false;

  };

  " . $this->jsCookies() . "
  " . $this->htmlCookies() . "

window.addEventListener('load', async e => {

  fetch(cookieManagerAppUrl).then((response) => {

    return response.json();

  }).then((cookieManager) => {

        if(docCookies.getItem(\"cookieManagerUserid\") === null){

          docCookies.setItem(\"cookieManagerUserid\", cookieManagerUserid, Infinity, \"/\");

        }

        ";

      }

      private function jsBottom() : void
      {

        $this->jsoutput .= "

        cookieManagerTemplate.innerHTML = cookieManagerAusgabe + cookieManagerHTMLCookies;
        document.body.appendChild(cookieManagerTemplate.content);

        const cookieManagercookieBar = document.getElementById('cookiemanager_cookiebar');
        const cookieManagerFingerprint = document.getElementById('cookiemanager_fingerprint');
        const cookieManagercookieBoxBg = document.getElementById('cookiemanager_cookiebox_bg');
        const cookieManagercookieBox = document.getElementById('cookiemanager_cookiebox');
        const cookieManagercookieBoxOpener = document.getElementsByClassName('cookiemanager_boxopener');
        const cookieManagercookieBoxCloser = document.getElementById('cookiemanager_cookiebox_close');
        const cookieManagerSwitcher = document.getElementsByClassName('cookiemanager_cookieswitcher');
        const cookieManagerSafer = document.getElementById('cookiemanager_cookiebox_accept');
        const cookieManagerAcceptAll = document.getElementById('cookiemanager_accept');

        const closeAll = () => {

          var closeUrl = cookieManagerCallUrl + docCookies.getItem(\"cookieManagerAllowLevel\") + '/' + 'S';

          fetch(closeUrl).then((response) => {

            cookieManagercookieBoxBg.style.display = 'none';
            cookieManagercookieBox.style.display = 'none';
            cookieManagercookieBar.style.display = 'none';
            cookieManagerFingerprint.style.backgroundColor = cookieManager.cookiebar.bgcolor;
            docCookies.setItem(\"cookieManagerChecksum\", cookieManager.cmchecksum, Infinity, \"/\");

          });

        }

        const pushAllowLevel = () => {

          var allowLevel = '0';

          for(var i = 0; i < cookieManagerSwitcher.length; i++) {

            if(cookieManagerSwitcher[i].getAttribute('status') == '1' && cookieManagerSwitcher[i].getAttribute('essential') != '1'){

              allowLevel = allowLevel + 'C' + cookieManagerSwitcher[i].getAttribute('name');

            }

          }

          docCookies.setItem(\"cookieManagerAllowLevel\", allowLevel, Infinity, \"/\");

        }

        const setStatus = (obj) => {

          var status = obj.getAttribute('status');
          var essential = obj.getAttribute('essential');

          if(essential != '1'){

            if(status == '1'){

              obj.setAttribute('status', '0');
              obj.src = cookieManager.switchoff;

            }else{

              obj.setAttribute('status', '1');
              obj.src = cookieManager.switchon;

            }

            pushAllowLevel();

          }

        }

        cookieManagerAcceptAll.addEventListener('click', function() {

          for(var i = 0; i < cookieManagerSwitcher.length; i++) {

            cookieManagerSwitcher[i].setAttribute('status', '1');
            cookieManagerSwitcher[i].src = cookieManager.switchon;

          }

          pushAllowLevel();
          closeAll();

        });

        cookieManagerSafer.addEventListener('click', function() {

          closeAll();

        });

        if(docCookies.getItem(\"cookieManagerChecksum\") !== cookieManager.cmchecksum){

          cookieManagercookieBar.style.display = 'block';
          cookieManagerFingerprint.style.backgroundColor = 'transparent';

        }
        for(var i = 0; i < cookieManagercookieBoxOpener.length; i++) {

          cookieManagercookieBoxOpener[i].addEventListener('click', function() {

            cookieManagercookieBoxBg.style.display = 'block';
            cookieManagercookieBox.style.display = 'block';

          });

        }
        for(var i = 0; i < cookieManagerSwitcher.length; i++) {

          cookieManagerSwitcher[i].addEventListener('click', function() {

            setStatus(this);

          });

        }
        cookieManagercookieBoxCloser.addEventListener('click', function() {

            cookieManagercookieBoxBg.style.display = 'none';
            cookieManagercookieBox.style.display = 'none';

        });

  });


});

        ";

      }

  }?>
