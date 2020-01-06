<?php if(isset($this->formhandle->errorm)){?>
  <?php if($this->formhandle->errorm!=""){?>
  <div class="alert alert-danger text-center" role="alert">
    <?php print $this->formhandle->errorm?>
  </div>
<?php }}?>
<?php if($this->httpvars->errorm!=""){?>
  <div class="alert alert-danger text-center" role="alert">
    <?php print $this->httpvars->errorm?>
  </div>
<?php }?>
<?php if(isset($this->formhandle->success)){?>
  <?php if($this->formhandle->success!=""){?>
  <div class="alert alert-success text-center" role="alert">
    <?php print $this->formhandle->success?>
  </div>
<?php }}?>
