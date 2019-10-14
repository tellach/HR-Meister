<!DOCTYPE html>
<html>
<head>
    <?php include('view/css_links.php'); ?>

</head>
<body>
<div class="login-box">
    <div class="login-logo">
        <img src="./public/dist/img/image3.jpg" style="width: 80px; height: 80px; border-radius: 50%;">
        <b>HR</b><a>Meister</a>
    </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h2><center>BIENVENUE</center></h2>
    </br>

    <form action="index.php?action=accueil" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Utilisateur" name="user">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!--<div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>-->
        <!-- /.col -->
        <?php if ((isset($erreur))&&($erreur==1)) { ?>  <a style="margin-left: 12px; color: red"><i class="icon fa  fa-warning"></i> Le username ou le mot de passe est incorrect !</a><?php } ?>
        <div class="col-xs-4">
            <br>
          <a href="index.php?action=page_recup_passwd">Mot de passe oublié ?</a><br>
          <br>
          <br>
          <br>
          <button type="submit" class="btn btn-primary btn-block btn-flat">S'identifier</button>
        </div>

        <!-- /.col -->
      </div>

    </form>

    <!--<div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->

    <!--<a href="#">Mot de passe oublié?</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php include('view/js_links.php'); ?>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
