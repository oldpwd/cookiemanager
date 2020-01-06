<br><br>
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1 class="text-center">CookieManager</h1>
      <h2 class="text-center"><?php print $this->httpvars->language['SUBHL_LOGIN']; ?></h2>
      <br>
      <?php if($this->httpvars->errorm!=""){ ?>
        <div class="alert alert-danger text-center" role="alert">
          <?php print $this->httpvars->errorm; ?>
        </div>
      <?php } ?>
      <br>
      <form method="post">
        <input type="hidden" name="token" value="<?php print $this->csrf->genToken("login"); ?>">
        <div class="form-group">
          <label for="benutzername"><?php print $this->httpvars->language['LABEL_LOGIN_USERNAME']; ?>:</label>
          <input type="text" class="form-control" name="benutzername" required>
        </div>
        <div class="form-group">
          <label for="passwort"><?php print $this->httpvars->language['LABEL_LOGIN_PASSWORD']; ?>:</label>
          <input type="password" class="form-control" name="passwort" required>
        </div>
        <br>
        <div class="text-center">
          <button type="submit" class="btn btn-primary sender">&raquo; <?php print $this->httpvars->language['BUTTON_LOGIN']; ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
