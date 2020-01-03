<?php
  declare(strict_types=1);

  # CookieManager is released under the GNU Public License, version 3 or later.
  # http://www.gnu.org/licenses/gpl-3.0-standalone.html
  # Author SL, JUSTilize GmbH, Frankfurt/Main

	namespace Cookiemanager\helper;


	class Siteelements
  {

			private $sitedata;

      private $httpvars;

      private $output = "";


      function __construct(&$sitedata, &$httpvars)
    	{

        $this->sitedata = $sitedata;

        $this->httpvars = $httpvars;

			}

      private function isInArray($id, &$array) : bool
      {

        foreach($array as $wert){

          if(isset($wert["website"])){

            if($wert["website"] === $id){

              return true;

            }

          }
          if($wert === $id){

            return true;

          }

        }

        return false;

      }

      public function genSelectList($array=[0]) : string
      {

        $this->output = "";

        foreach($this->sitedata->dbdata as $wert){

          $this->output .= '<option value="' . $wert["id"] . '"' . (($this->isInArray($wert["id"], $array))?(" selected=\"selected\""):("")) . '>' . $wert["name"] . '</option>';

        }

        return $this->output;

      }

      public function throwWsForm() : string
      {

        foreach($this->sitedata->dbdata as $wert){

          $this->output .= "<div class=\"form-group\">";
          $this->output .= "<label for=\"" . $wert["varname"] . "\">" . $this->httpvars->language[$wert["varname"]] . ":</label>";

          if($wert["input"] === "input"){

            $this->output .= "<input type=\"text\" class=\"form-control\" name=\"" . $wert["varname"] . "\" value=\"" . $wert["value"] . "\">";

          }else{

            $this->output .= "<textarea class=\"form-control\" name=\"" . $wert["varname"] . "\" rows=\"3\">";
            $this->output .= $wert["value"];
            $this->output .= "</textarea>";

          }

          $this->output .= "</div>";

        }
        return $this->output;

      }

  }?>
