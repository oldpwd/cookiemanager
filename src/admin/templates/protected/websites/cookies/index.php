  <div class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-md-6">
          <br>
          <h1 class="text-left">CookieManager</h1>
          <h2 class="text-left"><?php print $this->httpvars->language['NAV_6']; ?></h2>
          <?php require_once($this->router->elemdir . "websitesmenue.php"); ?>
          <div class="linie"></div>
          <h4><?php print $this->httpvars->language['WS_COOKIES_TITLE']; ?></h4>
          <span class="kleinschrift grayscale"><?php print $this->httpvars->language['LABEL_MULTI_SELECT']; ?></span>
          <br><br>
          <form method="post">
            <input type="hidden" name="token" value="<?php print $this->csrf->genToken("cookiestowebsite")?>">
            <input type="hidden" class="websitesid" name="id" value="<?php print $_POST["id"]?>">
            <div class="kleinschrift"><?php print $this->httpvars->language['LABEL_COOKIE_SEL']; ?></div>
            <select multiple class="form-control" name="cookieids[]" size="15">
                <?php foreach($this->sitedata->dbdata as $wert){ ?>
                  <option value="<?php print $wert["cookieid"]; ?>"<?php print ($wert["thissitecookie"]=="1")?(" selected=\"selected\""):(""); ?>>ID: <?php print $wert["cookieid"]; ?> - <?php print $wert["bezeichnung"]; ?> <?php print $wert["internalremarks"]; ?> - [<?php print $this->sitedata->cookieCatShortListing($wert["cookieid"]);?>] - (<?php print $wert["zugeordnet"]; ?>) - <?php print $wert["company"]; ?></option>
                <?php } ?>
            </select>
            <br>
            <button type="submit" class="btn btn-primary sender">&raquo;&nbsp;<?php print $this->httpvars->language['BUTTON_WS_COOKIESEL']; ?></button>
          </form>
        </div>
        <div class="col-md-6 previewer d-none d-md-block">
          <?php require_once($this->router->elemdir . "previewer.php"); ?>
        </div>
      </div>
    </div>
  </div>
