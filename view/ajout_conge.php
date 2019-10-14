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
                        <li><a href="index.php?action=list_conge_prez">Congés présents</a></li>
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
                Ajout d'un congé
            </h1>
        </section>

        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire d'ajout d'un nouveau congé</h3>
                        </div>

                        <div class="box-body form-group ">
                            <form action="index.php?action=ajout_conge" method="post" enctype="multipart/form-data"
                                  role="form">

                                <div class="form-group col-lg-12 <?php if (isset($retour) && ($retour == "employe")) echo 'has-error' ?>">
                                    <label class="control-label">Matricule</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-pound"></i>
                                        </div>
                                        <input type="text" id="author" class="form-control" name="matricule" required/>
                                    </div>
                                    <?php if (isset($retour) && ($retour == "employe")) { ?>
                                        <span class="help-block">Le matricule n'est pas valide ! Veuillez s'assurer qu'il existe un employé avec ce matricule</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label">Type de congé</label>
                                    <Select name="type_conge" id="Raison social" class="form-control" required>
                                        <optgroup>
                                            <option value="1"> Annuel</option>
                                            <option value="2"> Maladie</option>
                                            <option value="3"> Sans solde</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($retour) && ($retour != "employe") && ($retour != "valide") && ($retour != "") && ($retour != "form")) echo 'has-error' ?>">
                                    <label class="control-label">Date de début</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="datepicker" class="form-control" name="date_debut"
                                               required/>
                                    </div>
                                    <?php if (isset($retour) && ($retour == "actuelle>debut")) { ?>
                                        <span class="help-block">La date du début ne peut pas être infèrieur à la date actuelle !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($retour) && ($retour != "employe") && ($retour != "valide") && ($retour != "") && ($retour != "form")) echo 'has-error' ?>">
                                    <label for="author" class="control-label">Date de fin</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="datepicker2" class="form-control" name="date_fin"
                                               required/>


                                    </div>
                                    <?php if (isset($retour) && ($retour == "coupure")) { ?>
                                        <span class="help-block">L'employé a déjà un congé en cette periode , Entrer une autre date ou consulter la liste des congés pour avoir plus d'info !</span>
                                    <?php } ?>

                                    <?php if (isset($retour) && ($retour == "reste")) { ?>
                                        <span class="help-block">Le nombre de journée restante de congé pour cet employé est inferieur à la durée de ce congé ! Consulter les informations de cet employé pour plus d'info !</span>
                                    <?php } ?>

                                    <?php if (isset($retour) && ($retour == "fin>debut")) { ?>
                                        <span class="help-block">La date du fin ne peut pas être infèrieur à la date du début !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($retour) && ($retour == "form")) echo 'has-error' ?>">
                                    <label class="control-label"> Importer la demande de congé</label><br>
                                    <label class="btn btn-primary btn-file">Parcourir..
                                        <input type="file" name="f" value="Choisisez un fichier"
                                               onchange="previewfile()"
                                               required>
                                        <?php if ((isset($retour) && ($retour == "form"))) { ?>
                                            <span class="help-block">L'extension du fichier n'est pas vaide !</span>
                                        <?php } ?>
                                    </label>
                                </div>

                                <div class="box-footer col-lg-12">
                                    <input type="reset" class="btn btn-light pull-right" value="Effacer tout">
                                    <button type="submit" class="btn btn-success" name="valider"><span
                                                class="glyphicon glyphicon-send"></span> Valider
                                    </button>
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


    <script>
        $(function () {
            //Initialize Select2 Elements
            //$('.select2').select2()

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            })
            $('#datepicker2').datepicker({
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