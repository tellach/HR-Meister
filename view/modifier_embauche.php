<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php
$embauche = $embauches->fetch();
?> <!DOCTYPE html>
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
                </li>
                </li>
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
                Suivi des recrutements
            </h1>
        </section>
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire de modification des paramètres de l'entretien ... </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body form-group">

                            <form action="index.php?id=<?= $_GET['id'] ?>&amp;where=<?= $where ?>&amp;action=modifier_embauche"
                                  method="POST" enctype="multipart/form-data" id="contact_form" role="form">

                                <div class="form-group col-lg-12 <?php if (isset($error) && ($error == "date")) echo 'has-error' ?>">
                                    <label class="control-label"> Date de l'entretien </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" type="text" id="datepicker" name="datee"
                                               value="<?php echo $embauche['datee']; ?>"/>
                                    </div>
                                    <?php if (isset($error) && ($error == "date")) { ?>
                                        <span class="help-block">La date du début n'est pas valide !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Poste </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-quote"></i>
                                        </div>
                                        <input class="form-control" type="text" name="poste"
                                               value="<?php echo $embauche['poste']; ?>"/>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label">Numéro du candidat </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-pound"></i>
                                        </div>
                                        <input class="form-control" type="number" name="matricule"
                                               value="<?php echo $embauche['matricule']; ?>"/>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Salaire </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-social-usd"></i>
                                        </div>
                                        <input class="form-control" type="number" name="salaire"
                                               value="<?php echo $embauche['salaire']; ?>"/>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Expérience </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-clipboard"></i>
                                        </div>
                                        <input class="form-control" type="number" name="note"
                                               value="<?php echo $embauche['note']; ?>"/>
                                    </div>
                                </div>

                                <div class="box-footer col-lg-12">
                                    <label class="control-label"></label>
                                    <button type="submit" class="btn btn-success" name="valider"><span
                                                class="glyphicon glyphicon-send"></span> Valider </button>
                                    <a href="index.php?where=<?= $where ?>&amp;id=<?= $_GET['id'] ?>&amp;action=list_embauche"
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

    <!-- REQUIRED JS SCRIPTS -->

    <?php include('view/js_links.php'); ?>

    <script>
        $(function () {

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                format : "yyyy-mm-dd"
            })

        })
    </script>
</body>
</html>
    <?php
}
?>