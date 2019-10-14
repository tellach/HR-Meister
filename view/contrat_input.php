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
                <li class="active"><a href="index.php?action=list_employes"><i class="glyphicon glyphicon-folder-open"></i>
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
                Contrat de l'employé
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row ">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire de sauvegarde de contrat</h3>
                        </div>

                        <div class="box-body form-group"">
                            <form method="POST" action="index.php?id=<?=$_GET['id']?>&amp;action=contrat_modif"
                                  enctype="multipart/form-data"
                                  role="form">

                                <div class="form-group col-lg-12 <?php if (($error=='file')||($error=='extension')) echo 'has-error' ?> ">
                                    <label for="last_name" class="control-label">Contrat</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-pricetag"></i>
                                        </div>
                                        <input type="file" name="contrat" value="Choisisez un fichier"
                                               onchange="previewfile()" required/>
                                    </div>
                                    <?php if (($error=='file')||($error=='extension')) { ?>
                                        <span class="help-block">L'extension du fichier envoyé n'est pas valide ! Veuillez entrer un fichier .pdf ou une image</span>
                                    <?php } ?>
                                </div>

                                <div class="box-footer form-group col-lg-12">
                                    <button type="submit" class=" btn btn-success" name="valider"><span
                                                class="glyphicon glyphicon-send"></span> Valider
                                    </button>
                                    <a href="index.php?action=affichage_comptes"
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
    <?php include('view/control_sidebar.php'); ?>

    <!-- /.content-wrapper -->

    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <?php include('view/js_links.php'); ?>

</body>
</html>
    <?php
}
?>