<!doctype html>
<html dir="<?php print $this->httpvars->language['TEXT_DIRECTION']; ?>" lang="<?php print $this->router->language; ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="<?php print $this->httpvars->baseurl; ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>CookieManager</title>
  </head>
  <body>
  <?php if($this->httpvars->loggedin === true){ ?>
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-3 linkleiste">
            <div class="topmenue">
              <?php require_once($this->router->elemdir . "nav.php"); ?>
            </div>

          </div>
          <div class="col-md-9">
  <? } ?>
  <?php require_once($this->router->requirefile); ?>
  <?php if($this->httpvars->loggedin === true){ ?>
          </div>
      </div>
    </div>
  <? } ?>
    <br><br>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
