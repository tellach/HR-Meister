<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
    ?>
<?php
if($_SESSION['account_permission'] == 'G')
{
    header("Location:index.php?action=acces_refuse");
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
                <li class="active"><a href="index.php?action=affichage_comptes"><i class="glyphicon glyphicon-tags"></i>
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
                Ajout d'un compte
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row ">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire d'ajout d'un nouveau compte</h3>
                        </div>

                        <div class="box-body form-group">
                            <form method="POST" action="index.php?action=ajouter_admin_gestionnaire"
                                  enctype="multipart/form-data"
                                  role="form">

                                <div class="form-group col-lg-12">
                                    <label for="last_name" class="control-label">Nom</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-person"></i>
                                        </div>
                                        <input id="last_name" type="text" name="nom" class="validate form-control"
                                               required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="first_name" class="control-label">Prénom</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-person"></i>
                                        </div>
                                        <input id="first_name" type="text" name="prenom" class="validate form-control"
                                               required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($erreur) && ($erreur == "username")) echo 'has-error' ?>">
                                    <label for="psuedo" class="control-label">Pseudo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-pricetag"></i>
                                        </div>
                                        <input id="pseudo" type="text" name="username" class="validate form-control"
                                               required>
                                    </div>
                                    <?php if (isset($erreur) && ($erreur == "username")) { ?>
                                        <span class="help-block">Le nom d'utilisateur est déjà utilisé !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($erreur) && ($erreur == "email")) echo 'has-error' ?>">
                                    <label for="mail" class="control-label">E-mail</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-at"></i>
                                        </div>
                                        <input id="mail" type="text" name="email" class="validate form-control"
                                               required>
                                    </div>
                                    <?php if (isset($erreur) && ($erreur == "email")) { ?>
                                        <span class="help-block">L'adresse email est déjà utilisée !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12 ">
                                    <label for="password" class="control-label">Mot de passe</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-ios-medical"></i>
                                        </div>
                                        <input id="password" type="password" name="password" minlength="8"
                                               class="validate form-control"
                                               required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($erreur) && ($erreur == "password")) echo 'has-error' ?>">
                                    <label for="password-confirm" class="control-label" style="">Confirmation du mot de
                                        passe</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-ios-medical"></i>
                                        </div>
                                        <input id="password-confirm" type="password" name="valider_mot_de_passe" minlength="8"
                                               class="validate form-control" required>
                                    </div>
                                    <?php if (isset($erreur) && ($erreur == "password")) { ?>
                                        <span class="help-block">La confirmation du mot de passe est fausse !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label" for="privilege">Privilèges</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-ios-people"></i>
                                        </div>
                                        <select name="account_permission" id="privilege" class="form-control" required>
                                            <option value="" disabled selected>Type du compte</option>
                                            <option value="1">Administrateur</option>
                                            <option value="2">Gestionnaire</option>
                                        </select>
                                    </div>
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
    <?php
}
?>
