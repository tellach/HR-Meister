<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <?php include('view/css_links.php'); ?>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
        <?php include('view/UserAccountMenu.php'); ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <?php include('view/nom_logo_entreprise.php'); ?>


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
                <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> <span>Accueil</span></a></li>
                <li class="active"><a href="index.php?action=list_employes"><i
                                class="glyphicon glyphicon-folder-open"></i>
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
                </li
                </li>
                <li class="treeview">
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
                <li><a href="index.php?action=modification_entreprise_afiiche"><i class="glyphicon glyphicon-cog"></i>
                        <span>Paramètres généraux</span></a>
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
                Suivi des employés
            </h1>

        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire d'ajout d'un nouveau objectif</h3>
                        </div>
                        <div class="box-body form-group">
                            <form action="index.php?action=ajouter_objectif&amp;matricule=<?= $_GET['matricule'] ?>"
                                  method="POST"
                                  enctype="multipart/form-data" role="form">
                                <div class="form-group col-lg-12">
                                    <label for="objectif" class="control-label"> objectif </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-bookmark"></i>
                                        </div>
                                        <input type="text" id="objectif" name="objectif" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if ($error == 'error') echo 'has-error'; ?>">
                                    <label class="control-label">Date debut</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="datepicker" name="date_debut" class="form-control"
                                               value="">
                                    </div>
                                    <?php if (isset($error) && ($error == 'error')) { ?>
                                        <span class="help-block">La date du début ne peut pas être infèrieur à la date actuelle !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> type d'objectif </label>
                                    <select name="type_objectif" id="type_objectif" class="form-control">
                                        <option value="court terme">court terme</option>
                                        <option value="moyen terme">moyen terme</option>
                                        <option value="long terme">long terme</option>
                                    </select>
                                </div>

                                <div class="box-footer form-group">
                                    <button type="submit" class="btn btn-success" name="valider">Valider</button>
                                    <a href="index.php?action=affichage_objectifs&matricule=<?= $_GET['matricule'] ?>&amp;"
                                       class="btn btn-light pull-right">Retour</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <!--<footer class="main-footer">
      <div class="pull-right hidden-xs">
        Anything you want
      </div>
      <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
    </footer>-->

    <!-- Control Sidebar -->
    <!--<aside class="control-sidebar control-sidebar-dark">

      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>

      <div class="tab-content">

        <div class="tab-pane active" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
          </ul>
          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="pull-right-container">
                      <span class="label label-danger pull-right">70%</span>
                    </span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
          </ul>
        </div>
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Some information about this general settings option
              </p>
            </div>
          </form>
        </div>
      </div>
    </aside>-->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <!--<div class="control-sidebar-bg"></div>
  </div>-->
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <?php include('view/control_sidebar.php'); ?>

    <?php include('view/js_links.php'); ?>
    <script>
        $(function () {
            //Initialize Select2 Elements
            //$('.select2').select2()

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            })
        })

    </script>

</body>
</html>
    <?php
}
?>