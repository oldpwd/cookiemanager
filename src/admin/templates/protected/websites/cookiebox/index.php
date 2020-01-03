<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-md-6">
        <br>
        <h1 class="text-left">CookieManager</h1>
        <h2 class="text-left"><?php print $this->httpvars->language['NAV_5']; ?></h2>
        <?php require_once($this->router->elemdir . "websitesmenue.php"); ?>
        <div class="linie"></div>

        <form method="post">
          <input type="hidden" name="token" value="<?php print $this->csrf->genToken("cookieboxupdate")?>">
          <input type="hidden" name="id" value="<?php if(isset($_POST["id"])){ print $_POST["id"]; }?>">
          <?php print $this->siteelem->throwWsForm(); ?>
          <button type="submit" class="btn btn-primary sender">&raquo;&nbsp;<?php print $this->httpvars->language['BUTTON_SAVE']; ?></button>
        </form>
      </div>
      <div class="col-md-6 previewer d-none d-md-block">
        <?php require_once($this->router->elemdir . "previewer.php"); ?>
      </div>
    </div>



  </div>
</div>
