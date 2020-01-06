  <div class="row">
    <div class="col-12">
      <br>
      <h1>CookieManager</h1>
      <h2><?php print $this->httpvars->language['NAV_9']; ?></h2>
      <br>
      <?php require_once($this->router->elemdir . "errorm.php"); ?>
      <br>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col"><?php print $this->httpvars->language['TABLE_SETTINGS_COL1']; ?></th>
              <th scope="col"><?php print $this->httpvars->language['TABLE_SETTINGS_COL2']; ?></th>
              <th scope="col" class="text-center"><?php print $this->httpvars->language['TABLE_WEBSITES_ACTIVECOL']; ?></th>
              <th scope="col" colspan="3"><?php print $this->httpvars->language['TABLE_WEBSITES_ACTIONCOL']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($this->sitedata->data as $wert){ ?>
            <tr>
              <th scope="row"><?php print $wert["id"]; ?></th>
              <td><?php print $wert["username"]; ?></td>
              <td><?php print $wert["email"]; ?></td>
              <td class="text-center"><?php print $wert["active"]; ?></td>
              <td class="text-center actbutton"><img src="img/edit.png" class="hiddenaction" token="useredit" action="settings-edit.html" name="<?php print $wert["id"]; ?>" title="<?php print $this->httpvars->language['BUTTON_EDIT']; ?>"></td>
              <td>&nbsp;</td>
              <td class="text-center actbutton">
                <?php if($wert["id"]!="1"){ ?>
                <img class="hiddenaction" token="<?php print ($wert["active"]=="1")?("useroff"):("useron"); ?>" name="<?php print $wert["id"]; ?>" src="img/<?php print ($wert["active"]=="1")?("on"):("off"); ?>.png" alert="<?php print ($wert["active"]==1)?($this->httpvars->language['BUTTON_DEACTIVATE']):($this->httpvars->language['BUTTON_ACTIVATE']); ?>" title="<?php print ($wert["active"]==1)?($this->httpvars->language['BUTTON_DEACTIVATE']):($this->httpvars->language['BUTTON_ACTIVATE']); ?>">
              <?php } ?>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
