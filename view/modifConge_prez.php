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
                <li><a href="index.php?action=list_employes"><i class="glyphicon glyphicon-folder-open"></i>
                        <span>Suivi des employés</span></a></li>
                
                <li><a href="index.php?action=list_candidat"><i class="glyphicon glyphicon-briefcase"></i>
                        <span>Suivi des recrutements</span></a></li>
                <li class="treeview active">
                    <a href="#"><i class="fa fa-link"></i> <span>Gestion des congés</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="index.php?action=list_conge_pass">Congés passés</a></li>
                        <li class="active"><a href="index.php?action=list_conge_prez">Congés présents</a></li>
                        <li><a href="index.php?action=list_conge_venir">Congés à venir</a></li>
                        <li><a href="index.php?action=affichage_conge_global">Vue globale</a></li>
                    </ul>
                </li>
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
                <li><a href="index.php?action=affichage_comptes"><i class="glyphicon glyphicon-tags"></i>
                        <span>Gestion des comptes</span></a>
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
                Modification d'un congé présent
            </h1>

        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire de modification du congé en cours </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body form-group">
                            <form role="form" method="POST"
                                  action="index.php?modif=prez&action=modifier_conge&amp;id=<?= $_GET['id'] ?>&critere=date_fin">
                                <div class="form-group col-lg-12 <?php if (isset($retour)&&($retour!="")&&($retour!="valide")) echo 'has-error' ?>">
                                    <label class="form-control">Date de fin</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <?php $conge = $congeId->fetch();
                                        $date_fin = $conge['date_fin']; ?>
                                        <input class="form-control" id="datepicker" type="text"
                                               value="<?php echo $date_fin ?>" name="date">

                                    </div>
                                    <!-- /.input group2 -->
                                    <?php if (isset($retour)&&($retour=="fin<actuel")){ ?>
                                        <span class="help-block">La date du fin ne peut pas être infèrieur à la date actuelle !</span>
                                    <?php } ?>

                                    <?php if (isset($retour)&&($retour=="reste")){ ?>
                                        <span class="help-block">Le nombre de journée restante de congé pour cet employé est inferieur à la durée de ce congé ! Consulter les informations de cet employé pour plus d'info !</span>
                                    <?php } ?>

                                    <?php if (isset($retour)&&($retour=="coupure")){ ?>
                                        <span class="help-block">L'employé a déjà un congé en cette periode , Entrer une autre date ou consulter la liste des congés pour avoir plus d'info !</span>
                                    <?php } ?>

                                    <?php if (isset($retour)&&($retour=="fin<debut")){ ?>
                                        <span class="help-block">La date du fin ne peut pas être infèrieur à la date du debut !</span>
                                    <?php } ?>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer col-lg-12">
                                    <button type="submit" class="btn btn-success">Valider</button>
                                    <a href="index.php?action=list_conge_prez"
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

    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <?php include('view/control_sidebar.php'); ?>

    <?php include('view/js_links.php'); ?>

    <script>    //Date picker
        $(function () {

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