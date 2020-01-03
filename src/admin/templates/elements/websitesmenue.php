<?php if($this->sitedata->hostname != ""){ ?>
  <h3 class="text-left"><?php print $this->sitedata->hostname; ?></h3>
<?php } ?>
<br>
<?if(isset($this->formhandle->errorm) || $this->httpvars->errorm!=""){?>
  <?if($this->formhandle->errorm!="" || $this->httpvars->errorm!=""){?>
  <div class="alert alert-danger text-center" role="alert">
    <?=$this->httpvars->errorm?><?=$this->formhandle->errorm?>
  </div>
<?}}?>
<br>
