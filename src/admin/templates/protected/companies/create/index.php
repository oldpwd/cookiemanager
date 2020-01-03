<div class="row">
  <div class="col-12">
    <br>
    <h1>CookieManager</h1>
    <h2><?php print ($this->sitedata->dbobject->id)?($this->httpvars->language['NAV_16']):($this->httpvars->language['NAV_17']); ?></h2>
    <br>
    <?php if($this->sitedata->dbobject->id != ""){ ?>
      <div class="text-center"><a href="companies.html"><?php print $this->httpvars->language['LINK_BACK']; ?></a></div><br>
    <?php } ?>
    <?php require_once($this->router->elemdir . "errorm.php"); ?>
    <div class="linie">

    </div>
    <form action="companies<?php print ($this->sitedata->dbobject->id != "")?("-edit"):("")?>.html" method="post">
      <input type="hidden" name="token" value="<?php print $this->csrf->genToken(($this->sitedata->dbobject->id)?("companyedit"):("companycreate"));?>">
      <input type="hidden" name="id" value="<?php print $this->sitedata->dbobject->id; ?>">

      <label for="username"><?php print $this->httpvars->language['LABEL_COMPANYFORM1']; ?>:</label>
      <input type="text" name="name" class="form-control col-md-6" value="<?php print $this->sitedata->dbdataPushData("name"); ?>" required>
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_COMPANYFORM2']; ?>:</label>
      <input type="text" name="strasse" class="form-control col-md-6" value="<?php print $this->sitedata->dbdataPushData("strasse"); ?>">
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_COMPANYFORM3']; ?>:</label>
      <input type="text" name="ort" class="form-control col-md-6" value="<?php print $this->sitedata->dbdataPushData("ort"); ?>">
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_COMPANYFORM4']; ?>:</label>
      <input type="text" name="land" class="form-control col-md-6" value="<?php print $this->sitedata->dbdataPushData("land"); ?>" required>
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_COMPANYFORM5']; ?>:</label>
      <input type="text" name="url" class="form-control col-md-6" value="<?php print $this->sitedata->dbdataPushData("url"); ?>" required>
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_COMPANYFORM6']; ?>:</label>
      <input type="text" name="impressum" class="form-control col-md-6" value="<?php print $this->sitedata->dbdataPushData("impressum"); ?>" required>
      <br>
      <label for="username"><?php print $this->httpvars->language['LABEL_COMPANYFORM7']; ?>:</label>
      <input type="text" name="datenschutz" class="form-control col-md-6" value="<?php print $this->sitedata->dbdataPushData("datenschutz"); ?>" required>
      <br>
      <br>
      <button type="submit" class="btn btn-primary sender">&raquo;&nbsp;<?php print $this->httpvars->language['BUTTON_SAVE']; ?></button>
    </form>
  </div>
</div>
