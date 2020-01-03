<div class="row">
  <div class="col-12">
    <br>
    <h1>CookieManager</h1>
    <h2><?php print ($this->sitedata->dbobject->id)?($this->httpvars->language['NAV_14']):($this->httpvars->language['NAV_15']); ?></h2>
    <br>
    <?php if($this->sitedata->dbobject->id != ""){ ?>
      <div class="text-center"><a href="categories.html"><?php print $this->httpvars->language['LINK_BACK']; ?></a></div><br>
    <?php } ?>
    <?php require_once($this->router->elemdir . "errorm.php"); ?>
    <div class="linie">

    </div>
    <form action="categories<?php print ($this->sitedata->dbobject->id != "")?("-edit"):("")?>.html" method="post">
      <input type="hidden" name="token" value="<?php print $this->csrf->genToken(($this->sitedata->dbobject->id)?("categoryedit"):("categorycreate"));?>">
      <input type="hidden" name="id" value="<?php print $this->sitedata->dbobject->id; ?>">

      <label for="username"><?php print $this->httpvars->language['LABEL_CATEGORYFORM1']; ?>:</label>
      <input type="text" name="name" class="form-control col-md-6"<?php print ($this->sitedata->dbobject->id)?(" readonly=\"readonly\""):("")?> value="<?php print $this->sitedata->dbdataPushData("name"); ?>" required>
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_CATEGORYFORM2']; ?>:</label>
<textarea class="form-control col-md-6" rows="5" name="description" required><?php print $this->sitedata->dbdataPushData("description"); ?></textarea>
      <br>
      <br>
      <button type="submit" class="btn btn-primary sender">&raquo;&nbsp;<?php print $this->httpvars->language['BUTTON_SAVE']; ?></button>
    </form>
  </div>
</div>
