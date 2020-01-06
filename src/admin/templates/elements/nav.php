<a href="<?php print $this->httpvars->baseurl; ?>"<?php print ($this->router->site[0] == "index")?(" class=\"aktiv\""):(""); ?>><?php print $this->httpvars->language['NAV_1']; ?></a>
<a href="websites.html"<?php print ($this->router->site[0] == "websites" && isset($this->router->site[1]) === false)?(" class=\"aktiv\""):(""); ?>><?php print $this->httpvars->language['NAV_2']; ?></a>
<?php if($this->router->site[0] === "websites" && isset($_POST["id"])){ ?>
  <a href="#void" token="websitessites" name="<?php if(isset($_POST["id"])){ print $_POST["id"]; }?>" action="websites-cookiebar.html" class="hiddenaction sublink<?php print ($this->router->linkIsActive(["websites","cookiebar"]))?(" aktiv"):(""); ?>">&nbsp;&raquo;&nbsp;<?php print $this->httpvars->language['NAV_4']; ?></a>
  <a href="#void" token="websitessites" name="<?php if(isset($_POST["id"])){ print $_POST["id"]; }?>" action="websites-cookiebox.html" class="hiddenaction sublink<?php print ($this->router->linkIsActive(["websites","cookiebox"]))?(" aktiv"):(""); ?>">&nbsp;&raquo;&nbsp;<?php print $this->httpvars->language['NAV_5']; ?></a>
  <a href="#void" token="websitessites" name="<?php if(isset($_POST["id"])){ print $_POST["id"]; }?>" action="websites-cookies.html" class="hiddenaction sublink<?php print ($this->router->linkIsActive(["websites","cookies"]))?(" aktiv"):(""); ?>">&nbsp;&raquo;&nbsp;<?php print $this->httpvars->language['NAV_6']; ?></a>
<?php } ?>
<a href="cookies.html"<?php print ($this->router->site[0] == "cookies" && isset($this->router->site[1]) === false) || ($this->router->site[0] == "cookies" && isset($_POST["id"]))?(" class=\"aktiv\""):(""); ?>><?php print $this->httpvars->language['NAV_3']; ?></a>
<?php if($this->router->site[0] === "cookies"){ ?>
<a href="cookies-create.html" class="sublink<?php print ($this->router->linkIsActive(["cookies","create"]))?(" aktiv"):(""); ?>">&nbsp;&raquo;&nbsp;<?php print $this->httpvars->language['NAV_11']; ?></a>
<?php } ?>
<a href="categories.html"<?php print ($this->router->site[0] == "categories" && isset($this->router->site[1]) === false) || ($this->router->site[0] == "categories" && isset($_POST["id"]))?(" class=\"aktiv\""):(""); ?>><?php print $this->httpvars->language['NAV_7']; ?></a>
<?php if($this->router->site[0] === "categories"){ ?>
<a href="categories-create.html" class="sublink<?php print ($this->router->linkIsActive(["categories","create"]))?(" aktiv"):(""); ?>">&nbsp;&raquo;&nbsp;<?php print $this->httpvars->language['NAV_15']; ?></a>
<?php } ?>

<a href="companies.html"<?php print ($this->router->site[0] == "companies" && isset($this->router->site[1]) === false) || ($this->router->site[0] == "companies" && isset($_POST["id"]))?(" class=\"aktiv\""):(""); ?>><?php print $this->httpvars->language['NAV_8']; ?></a>
<?php if($this->router->site[0] === "companies"){ ?>
<a href="companies-create.html" class="sublink<?php print ($this->router->linkIsActive(["companies","create"]))?(" aktiv"):(""); ?>">&nbsp;&raquo;&nbsp;<?php print $this->httpvars->language['NAV_17']; ?></a>
<?php } ?>

<a href="settings.html"<?php print ($this->router->site[0] == "settings" && isset($this->router->site[1]) === false) || ($this->router->site[0] == "settings" && isset($_POST["id"]))?(" class=\"aktiv\""):(""); ?>><?php print $this->httpvars->language['NAV_9']; ?></a>
<?php if($this->router->site[0] === "settings"){ ?>
<a href="settings-create.html" class="sublink<?php print ($this->router->linkIsActive(["settings","create"]))?(" aktiv"):(""); ?>">&nbsp;&raquo;&nbsp;<?php print $this->httpvars->language['NAV_13']; ?></a>
<?php } ?>

<form method="post">
  <input type="hidden" name="token" value="<?php print $this->csrf->genToken("logout")?>">
  <br>
  <div class="text-center">
    <button type="submit" class="btn btn-primary sender">&raquo; <?php print $this->httpvars->language['BUTTON_LOGOUT']; ?></button>
  </div>
</form>

<form method="post" class="hiddenactions" action="">
  <input type="hidden" name="token" class="hiddenactiontoken" value="">
  <input type="hidden" name="id" class="hiddenactionid" value="">
</form>
<?php if($this->router->site[0] === "settings"){ ?>
<span id="useron" token="<?php print $this->csrf->genToken("useron");?>"></span>
<span id="useroff" token="<?php print $this->csrf->genToken("useroff");?>"></span>
<?php } ?>
<?php if($this->router->site[0] === "cookies"){ ?>
<span id="cookieon" token="<?php print $this->csrf->genToken("cookieon");?>"></span>
<span id="cookieoff" token="<?php print $this->csrf->genToken("cookieoff");?>"></span>
<span id="cookiedelete" token="<?php print $this->csrf->genToken("cookiedelete");?>"></span>
<?php } ?>
<?php if($this->router->site[0] === "categories"){ ?>
<span id="categoryon" token="<?php print $this->csrf->genToken("categoryon");?>"></span>
<span id="categoryoff" token="<?php print $this->csrf->genToken("categoryoff");?>"></span>
<span id="categorydelete" token="<?php print $this->csrf->genToken("categorydelete");?>"></span>
<?php } ?>
<?php if($this->router->site[0] === "companies"){ ?>
<span id="companydelete" token="<?php print $this->csrf->genToken("companydelete");?>"></span>
<?php } ?>
<?php if($this->router->site[0] === "websites"){ ?>
<span id="websitessites" token="<?php print $this->csrf->genToken("websites-sites")?>"></span>
<span id="websiteon" token="<?php print $this->csrf->genToken("websiteon");?>"></span>
<span id="websiteoff" token="<?php print $this->csrf->genToken("websiteoff");?>"></span>
<span id="websitedelete" token="<?php print $this->csrf->genToken("websitedelete");?>"></span>


<div class="hostnameupdateform">
  <form method="post" title="Ändern und [ENTER]">
    <input type="hidden" name="token" value="<?php print $this->csrf->genToken("websiteupdate")?>">
    <input type="hidden" class="websitesid" name="id" value="">
    <div class="row">
      <div class="col-12">
        <input type="text" class="form-control hostnametoupdate" name="hostname" value="" required>
      </div>
      <div class="d-none">
        <button type="submit" class="btn btn-primary sender" title="Hostname ändern">&raquo;&nbsp;OK</button>
      </div>
    </div>
  </form>
</div>
<?php }?>
