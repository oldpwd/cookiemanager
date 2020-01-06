<?php if($this->sitedata->hostname != ""){ ?>
  <h3 class="text-left"><?php print $this->sitedata->hostname; ?></h3>
<?php } ?>
<br>
<?php if(isset($this->formhandle->errorm) || $this->httpvars->errorm!=""){?>
  <?php if($this->formhandle->errorm!="" || $this->httpvars->errorm!=""){?>
  <div class="alert alert-danger text-center" role="alert">
    <?php print $this->httpvars->errorm?><?php print $this->formhandle->errorm?>
  </div>
<?php }}?>
<br>
