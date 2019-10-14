
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

    <form action="index.php?action=reinitialisation_password" method="post">
        <p>Un e-mail contenant un code de validation a été envoyé a votre adresse mail.<br><br>Veuiller saisir votre adresse mail et le code</p>
        </br>
        <br>
        <div class="form-group has-feedback <?php if (isset($error)&&($error=='adresse mail invalide')) echo 'has-error' ?>">
            <input type="email" class="form-control" placeholder="Email" name="email_recup" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <?php if (isset($error)&&($error=='adresse mail invalide')) { ?>
                <span class="help-block">Aucun compte ne correspend à cette adresse !</span>
            <?php } ?>
        </div>
        <div class="form-group has-feedback <?php if (isset($error)&&($error=='code incorrect')) echo 'has-error' ?> ">
            <input type="number" class="form-control" placeholder="Code" name="code" required>
            <span class="fa  fa-unlock-alt form-control-feedback" ></span>
            <?php if (isset($error)&&($error=='code incorrect')) { ?>
                <span class="help-block">Le code entré est incorrect !</span>
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
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit_val" value="valider">Valider</button>
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
