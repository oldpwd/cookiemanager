<div class="row">
  <div class="col-12">
    <br>
    <h1>CookieManager</h1>
    <h2><?php print ($this->sitedata->userid)?($this->httpvars->language['NAV_12']):($this->httpvars->language['NAV_13']); ?></h2>
    <br>
    <?php if($this->sitedata->userid != ""){ ?>
      <div class="text-center"><a href="settings.html"><?php print $this->httpvars->language['LINK_BACK']; ?></a></div><br>
    <?php } ?>
    <?php require_once($this->router->elemdir . "errorm.php"); ?>
    <div class="linie">

    </div>
    <form action="settings<?php print ($this->sitedata->userid != "")?("-edit"):("")?>.html" method="post">
      <input type="hidden" name="token" value="<?php print $this->csrf->genToken(($this->sitedata->userid)?("useredit"):("usercreate"));?>">
      <input type="hidden" name="id" value="<?php print $this->sitedata->userid; ?>">

      <label for="username"><?php print $this->httpvars->language['LABEL_SETTINGSFORM1']; ?>:</label>
      <input type="text" name="username" class="form-control col-md-6"<?php print ($this->sitedata->userid)?(" readonly=\"readonly\""):("")?> value="<?php print $this->sitedata->dbdataPushData("username"); ?>" required>
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_SETTINGSFORM2']; ?>:</label>
      <input type="text" name="email" class="form-control col-md-6" value="<?php print $this->sitedata->dbdataPushData("email"); ?>">
      <br>
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_SETTINGSFORM3']; ?>:</label>
      <input type="password" name="pass1" class="form-control col-md-6"<?php print ($this->sitedata->userid)?(""):(" required")?>>
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_SETTINGSFORM4']; ?>:</label>
      <input type="password" name="pass2" class="form-control col-md-6"<?php print ($this->sitedata->userid)?(""):(" required")?>>
      <br>
      <br>
      <button type="submit" class="btn btn-primary sender">&raquo;&nbsp;<?php print $this->httpvars->language['BUTTON_SAVE']; ?></button>
    </form>

  </div>
</div>
