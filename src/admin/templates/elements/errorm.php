<?if(isset($this->formhandle->errorm)){?>
  <?if($this->formhandle->errorm!=""){?>
  <div class="alert alert-danger text-center" role="alert">
    <?=$this->formhandle->errorm?>
  </div>
<?}}?>
<?if($this->httpvars->errorm!=""){?>
  <div class="alert alert-danger text-center" role="alert">
    <?=$this->httpvars->errorm?>
  </div>
<?}?>
<?if(isset($this->formhandle->success)){?>
  <?if($this->formhandle->success!=""){?>
  <div class="alert alert-success text-center" role="alert">
    <?=$this->formhandle->success?>
  </div>
<?}}?>
