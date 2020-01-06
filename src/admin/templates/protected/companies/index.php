<div class="row">
  <div class="col-12">
    <br>
    <h1>CookieManager</h1>
    <h2><?php print $this->httpvars->language['NAV_8']; ?></h2>
    <br>
    <?php require_once($this->router->elemdir . "errorm.php"); ?>
    <br>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col"><?php print $this->httpvars->language['TABLE_NAME']; ?></th>
            <th scope="col"><?php print $this->httpvars->language['TABLE_COMPANY_COL1']; ?></th>
            <th scope="col" class="text-center"><?php print $this->httpvars->language['TABLE_COMPANY_COL2']; ?></th>
            <th scope="col" colspan="4"><?php print $this->httpvars->language['TABLE_WEBSITES_ACTIONCOL']; ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($this->sitedata->data as $wert){ ?>
          <tr>
            <th scope="row"><?php print $wert["id"]; ?></th>
            <td><?php print $wert["name"]; ?></td>
            <td><a href="<?php print $wert["url"]; ?>" target="_blank"><?php print $wert["url"]; ?></a></td>
            <td class="text-center"><?php print $wert["anzcookies"]; ?></td>
            <td class="text-center actbutton"><img src="img/edit.png" class="hiddenaction" token="companyedit" action="companies-edit.html" name="<?php print $wert["id"]; ?>" title="<?php print $this->httpvars->language['BUTTON_EDIT']; ?>"></td>
            <td>&nbsp;</td>
            <td class="text-center actbutton">
              <?php if($wert["id"]!="1"){ ?>
              <img class="hiddenaction" token="companydelete" name="<?php print $wert["id"]; ?>" src="img/delete.png" alert="<?php print $this->httpvars->language['BUTTON_DELETE']; ?>" title="<?php print $this->httpvars->language['BUTTON_DELETE']; ?>">
            <?php } ?>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
