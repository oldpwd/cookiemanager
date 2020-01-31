<div class="row">
  <div class="col-12">
    <br>
    <h1>CookieManager</h1>
    <h2><?php print ($this->sitedata->cookieid)?($this->httpvars->language['NAV_10']):($this->httpvars->language['NAV_11']); ?></h2>
    <br>
    <?php if($this->sitedata->cookieid != ""){ ?>
      <div class="text-center"><a href="cookies.html"><?php print $this->httpvars->language['LINK_BACK']; ?></a></div><br>
    <?php } ?>
    <?php require_once($this->router->elemdir . "errorm.php"); ?>
    <div class="linie">

    </div>
    <form action="cookies<?php print ($this->sitedata->cookieid != "")?("-edit"):("")?>.html" method="post">
      <input type="hidden" name="token" value="<?php print $this->csrf->genToken(($this->sitedata->cookieid)?("cookieedit"):("cookiecreate"));?>">
      <input type="hidden" name="id" value="<?php print $this->sitedata->cookieid; ?>">
      <label for="name"><?php print $this->httpvars->language['LABEL_COOKIEFORM1']; ?>:</label>
      <input type="text" name="name" class="form-control col-md-6"<?php print ($this->sitedata->cookieid === "1")?(" readonly=\"readonly\""):("")?> value="<?php print $this->sitedata->cookiePushData("name"); ?>" required>
      <br>
      <label for="name"><?php print $this->httpvars->language['LABEL_COOKIEFORM2']; ?>:</label>
      <input type="text" name="internalremarks" class="form-control col-md-6" value="<?php print $this->sitedata->cookiePushData("internalremarks"); ?>">
      <br>
      <label for="websites"><?php print $this->httpvars->language['LABEL_COOKIEFORM3']; ?>:</label>&nbsp;<a href="websites.html" class="kleinschrift">&raquo;<?php print $this->httpvars->language['LINK_NEW1']; ?></a><br>
      <select multiple size="5" name="websites[]" class="form-control col-md-6"<?php print ($this->sitedata->cookieid === "1")?("  disabled=\"true\""):("")?>>
        <?php
          $this->sitedata->webElementsFetchCookieRequiredListing('cookie_websites');
          print $this->siteelem->genSelectList(($this->sitedata->cookieid)?($this->sitedata->multidata['cookie2websites']):([0]));
        ?>
      </select>
      <span class="kleinschrift grayscale"><?php print $this->httpvars->language['LABEL_MULTI_SELECT']; ?></span><br>
      <br>
      <label for="category"><?php print $this->httpvars->language['LABEL_COOKIEFORM4']; ?>:</label>&nbsp;<a href="categories-create.html" class="kleinschrift">&raquo;<?php print $this->httpvars->language['LINK_NEW2']; ?></a><br>
      <select name="category" class="form-control col-md-6"<?php print ($this->sitedata->cookieid === "1")?(" disabled=\"true\""):("")?> required>
        <?php
          $this->sitedata->webElementsFetchCookieRequiredListing('cookie_categories');
          print $this->siteelem->genSelectList([$this->sitedata->cookiePushData("category")]);
        ?>
      </select>
      <br>
      <label for="company"><?php print $this->httpvars->language['LABEL_COOKIEFORM5']; ?>:</label>&nbsp;<a href="companies-create.html" class="kleinschrift">&raquo;<?php print $this->httpvars->language['LINK_NEW3']; ?></a>
      <select name="company" class="form-control col-md-6" required>
        <?php
          $this->sitedata->webElementsFetchCookieRequiredListing('cookie_companies');
          print $this->siteelem->genSelectList([$this->sitedata->cookiePushData("company")]);
        ?>
      </select>
      <br>
      <label for="beschreibung"><?php print $this->httpvars->language['LABEL_COOKIEFORM6']; ?>:</label>
<textarea class="form-control col-md-6" rows="5" name="beschreibung" required>
<?php print $this->sitedata->cookiePushData("beschreibung"); ?></textarea>
      <br>
      <label for="personenbezogenedaten"><?php print $this->httpvars->language['LABEL_COOKIEFORM7']; ?>:</label>
<textarea class="form-control col-md-6" rows="3" name="personenbezogenedaten" required>
<?php print $this->sitedata->cookiePushData("personenbezogenedaten"); ?></textarea>
      <br>
      <label for="landderdatenerfassung"><?php print $this->httpvars->language['LABEL_COOKIEFORM8']; ?>:</label>
      <input type="text" name="landderdatenerfassung" class="form-control col-md-6" value="<?php print $this->sitedata->cookiePushData("landderdatenerfassung"); ?>" required>
      <br>
      <label for="wirdgeloeschtnach"><?php print $this->httpvars->language['LABEL_COOKIEFORM9']; ?>:</label>
      <input type="text" name="wirdgeloeschtnach" class="form-control col-md-6" value="<?php print $this->sitedata->cookiePushData("wirdgeloeschtnach"); ?>"  required>
      <br>
      <label for="sourcetype"><?php print $this->httpvars->language['LABEL_COOKIEFORM10']; ?>:</label>
      <select name="sourcetype" class="form-control col-md-6"<?php print ($this->sitedata->cookieid === "1")?("  disabled=\"true\""):("")?> required>
        <?php
          $this->sitedata->webElementsFetchCookieRequiredListing('cookie_sourcetypes');
          print $this->siteelem->genSelectList([$this->sitedata->cookiePushData("sourcetype")]);
        ?>
      </select>
      <br>
      <label for="opttype">Opt-Mode:</label>
      <select name="opttype" class="form-control col-md-6"<?php print ($this->sitedata->cookieid === "1")?("  disabled=\"true\""):("")?> required>
        <option value="1"<?php print ($this->sitedata->cookiePushData("opttype") == "1")?("  selected=\"selected\""):("")?>>Opt-In</option>
        <option value="2"<?php print ($this->sitedata->cookiePushData("opttype") == "2")?("  selected=\"selected\""):("")?>>Opt-Out</option>
      </select>
      <br>
      <label for="sourcecode"><?php print $this->httpvars->language['LABEL_COOKIEFORM11']; ?>:</label>
<textarea class="form-control col-md-6" rows="5" name="sourcecode"<?php print ($this->sitedata->cookieid === "1")?(" readonly=\"readonly\""):("")?>>
<?php print $this->sitedata->cookiePushData("sourcecode"); ?></textarea>
      <br>
      <button type="submit" class="btn btn-primary sender">&raquo;&nbsp;<?php print $this->httpvars->language['BUTTON_SAVE']; ?></button>
    </form>

  </div>
</div>
