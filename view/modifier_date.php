<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php
$embauche=$don;
?> <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Acceuil</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="public/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="public/dist/css/skins/skin-blue.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="Acceuil.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>G</b>RH</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>GRH</b>Project</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="public/dist/img/fouzi.jpg" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">Oukacha Fouzi</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="public/dist/img/fouzi.jpg" class="img-circle" alt="User Image">

                                <p>
                                    Oukacha Fouzi</br>
                                    gf_oukacha@esi.dz
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col text-center">
                                        <p>Poste : responsabe le GRH</br>
                                            Privilèges : Admin gestionnaire</br>
                                            Statut : Actif</p>
                                    </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="public/dist/img/logo.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    </br>
                    <p>Nom de l'entreprise</p>
                </div>
            </div>

            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <?php include('view/nom_logo_entreprise.php') ; ?>
                <!-- search form (Optional) -->
                <!--<form action="#" method="get" class="sidebar-form">
                  <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                      </span>
                  </div>
                </form>-->
                <!-- /.search form -->

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Menu</li>
                    <!-- Optionally, you can add icons to the links -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> <span>Acceuil</span></a></li>
                    <li><a href="index.php?action=list_employes"><i class="glyphicon glyphicon-folder-open"></i>
                            <span>Suivi des employés</span></a></li>

                    <li><a href="index.php?action=list_candidat"><i class="glyphicon glyphicon-briefcase"></i>
                            <span>Suivi des recrutements</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-link"></i> <span>Gestion des congés</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="index.php?action=list_conge_pass">Congés passés</a></li>
                            <li><a href="index.php?action=list_conge_prez">Congés présents</a></li>
                            <li><a href="index.php?action=list_conge_venir">Congés à venir</a></li>
                            <li><a href="index.php?action=affichage_conge_global">Vue globale</a></li>
                        </ul>
                    </li                </li>
                    <li class="treeview active">
                        <a href="#"><i class="glyphicon glyphicon-calendar"></i> <span>Entretiens d'embauche</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="index.php?action=list_entretien_pass">Entretiens passés</a></li>
                            <li><a href="index.php?action=list_entretien_today">Entretiens pour aujourd'hui</a></li>
                            <li><a href="index.php?action=list_entretien_venir">Entretiens à venir</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php?action=affichage_comptes"><i class="glyphicon glyphicon-tags"></i> <span>Gestion des comptes</span></a>
                    </li>
                    <li><a href="index.php?action=modification_entreprise_afiiche"><i class="glyphicon glyphicon-cog"></i> <span>Paramètres généraux</span></a>
                    </li>
                </ul>
                <!-- /.sidebar-menu -->      <!-- /.sidebar-menu -->
            </section>
        <!-- /.sidebar -->
    </aside>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Suivi des recrutements
            </h1>
        </section>
        <section class="content container-fluid">
            <h3>Reporter un entretien</h3>
            <div class="box box-primary center-block" style="width:500px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulaire de modification de la date de l'entretien ... </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form action="index.php?where=<?=$where?>&amp;id=<?=$_GET['id']?>&amp;action=report_embauche" method="POST" enctype="multipart/form-data" class="well form-horizontal"  id="contact_form">

                    </br>
                    <div class="form-group">
                        <label class="col-md-4 control-label "> Date de l'entretien </label>
                        <div class="col-md-4 inputGroupContainer <?php if(isset($error)&&($error=='date')) echo 'has-error' ?>">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input  class="form-control" type="date" name="datee" value="<?php echo $embauche['datee']; ?>"/>
                            </div>
                            <?php if (isset($error) && ($error == "date")) { ?>
                                <span class="help-block">La date du début n'est pas valide !</span>
                            <?php } ?>
                        </div>
                    </div>

                    <div><input name='id' id="id" type='hidden' value="<?php echo $id; ?>" </div>


                    </br>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success" name="valider" > Valider <span class="glyphicon glyphicon-send"></span></button>
                        </div>
                        <a href="index.php?where=<?=$where?>&amp;emb=<?=$id?>&amp;action=list_embauche" class="btn btn-light pull-right">Retour</a>

                    </div>

                </form>
            </div>
        </section>



        <!-- Main content -->
        <section class="content container-fluid">

        </section>
        <!-- /.content -->
    </div>

    <!-- jQuery 3 -->
    <script src="public/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="public/dist/js/adminlte.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. -->
</body>
</html><?php
}
?>