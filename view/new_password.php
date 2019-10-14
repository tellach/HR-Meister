<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Récupération de compte</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="public/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" type="text/css" href="public/active.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="login-box">
    <div class="login-logo">
        <img src="./public/dist/img/image3.jpg" style="width: 80px; height: 80px; border-radius: 50%;">
        <b>HR</b><a>Meister</a>
    </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h3>Récupération de compte</h3>
    </br>

    <form action="index.php?action=new_password&amp;id=<?=$_GET['id'];?>" method="post">
        <p>Veuillez saisir le nouveau mot de passe</p>
        </br>
        <br>
        <div class="form-group has-feedback " >
            <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback <?php if (isset($error)&&($error=='validation incorrect')) echo 'has-error' ?>">
            <input type="password" class="form-control" placeholder="Confirmation du mot de passe" name="val_password" required>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            <?php if (isset($error)&&($error=='validation incorrect')) { ?>
                <span class="help-block">La confirmation du mot de passe est incorrect !</span>
            <?php } ?>
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

        <div class="col-xs-4">
          <br>
          <br>
          <button type="submit" value="valider" name="valider" class="btn btn-primary btn-block btn-flat">Valider</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
      <br>

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

<!-- jQuery 3 -->
<script src="public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="public/plugins/iCheck/icheck.min.js"></script>
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
