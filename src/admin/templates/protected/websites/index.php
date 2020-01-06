  <div class="row">
    <div class="col-12">
      <br>
      <h1>CookieManager</h1>
      <h2><?php print $this->httpvars->language['NAV_2']; ?></h2>
      <br>
      <?php require_once($this->router->elemdir . "errorm.php"); ?>
      <div class="linie">

      </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col"><?php print $this->httpvars->language['TABLE_WEBSITES_COL1']; ?></th>
              <th scope="col"><?php print $this->httpvars->language['TABLE_WEBSITES_COL2']; ?></th>
              <th scope="col" class="text-center"><?php print $this->httpvars->language['TABLE_WEBSITES_COL3']; ?></th>
              <th scope="col" class="text-center"><?php print $this->httpvars->language['TABLE_WEBSITES_ACTIVECOL']; ?></th>
              <th scope="col" colspan="4"><?php print $this->httpvars->language['TABLE_WEBSITES_ACTIONCOL']; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($this->sitedata->data as $wert){ ?>
            <tr>
              <th scope="row"><?php print $wert["id"]; ?></th>
              <td class="websitemenu" action="<?php print $wert["host"]; ?>" newname="<?php print $wert["id"]; ?>" name="<?php print $wert["id"]; ?>" title="<?php print $this->httpvars->language['HOSTNAME_TITLE']; ?>"><?php print $wert["host"]; ?></td>
              <td>
                <form>
<textarea class="form-control tag" rows="3" readonly>
&lt;script&nbsp;src=&quot;<?php print str_replace('admin/', '', $this->httpvars->baseurl) . $wert["token"]; ?>/&quot;&gt;&lt;/script&gt;
</textarea>
                </form>
              </td>
              <td class="text-center"><?php print $wert["anzahl"]; ?></td>
              <td class="text-center"><?php print $wert["active"]; ?></td>
              <td class="text-center actbutton"><img src="img/edit.png" class="hiddenaction" token="websitessites" action="websites-cookiebar.html" name="<?php print $wert["id"]; ?>" title="<?php print $this->httpvars->language['BUTTON_EDIT']; ?>"></td>
              <td>&nbsp;</td>
              <td class="text-center actbutton">
                <img class="hiddenaction" token="<?php print ($wert["active"]==1)?("websiteoff"):("websiteon"); ?>" name="<?php print $wert["id"]; ?>" src="img/<?php print ($wert["active"]==1)?("on"):("off"); ?>.png" alert="<?php print ($wert["active"]==1)?($this->httpvars->language['BUTTON_DEACTIVATE']):($this->httpvars->language['BUTTON_ACTIVATE']); ?>" title="<?php print ($wert["active"]==1)?($this->httpvars->language['BUTTON_DEACTIVATE']):($this->httpvars->language['BUTTON_ACTIVATE']); ?>">
              </td>
              <td class="text-center actbutton">
                <img class="hiddenaction" token="websitedelete" name="<?php print $wert["id"]; ?>" src="img/delete.png" alert="<?php print $this->httpvars->language['BUTTON_DELETE']; ?>" title="<?php print $this->httpvars->language['BUTTON_DELETE']; ?>">
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="linie">

      </div>
        <form method="post">
          <input type="hidden" name="token" value="<?php print $this->csrf->genToken("websitenew")?>">
          <div class="row">
            <div class="col-md-3">
              <br><b><?php print $this->httpvars->language['LABEL_NEW_SITE']; ?>:</b>
            </div>
            <div class="col-md-6">
              <br><input type="text" class="form-control" name="domain" placeholder="www.domain.com" required>
            </div>
            <div class="col-md-3">
              <br><button type="submit" class="btn btn-primary sender">&raquo;&nbsp;<?php print $this->httpvars->language['BUTTON_NEW_SITE']; ?></button>
            </div>
          </div>
        </form>

    <!-- </div> removed -->
    </div>
  </div>
