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
<?php
$compte = $comptes->fetch();
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
                Modification d'un compte
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row ">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Modifier les paramètres
                                de <?php echo $compte['nom'] . ' ' . $compte['prenom']; ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body form-group">
                            <form role="form" method="POST"
                                  action="index.php?id=<?= $_GET['id'] ?>&amp;action=modifier_compte">

                                <div class="form-group col-lg-12">
                                    <label form="compteInputNom">Nom</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-person"></i>
                                        </div>
                                    <input class="form-control" name="nom" value="<?php echo $compte['nom']; ?>"
                                           type="text" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label form="compteInputPrenom">Prénom</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-person"></i>
                                        </div>
                                    <input class="form-control" name="prenom"
                                           value="<?php echo $compte['prenom']; ?>"
                                           type="text" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12  <?php if (isset($erreur)&&($erreur=="username")) echo 'has-error' ?>">
                                    <label form="compteInputPseudo">Pseudo</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-pricetag"></i>
                                        </div>
                                    <input class="form-control" name="username"
                                           value="<?php echo $compte['username']; ?>" type="text" required>
                                    </div>
                                    <?php if (isset($erreur)&&($erreur=="username")){ ?>
                                        <span class="help-block">Le nom d'utilisateur est déjà utilisé !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($erreur)&&($erreur=="email")) echo 'has-error' ?>">
                                    <label for="compteInputEmail1">E-mail</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-at"></i>
                                        </div>
                                    <input class="form-control" name="email" id="compteInputEmail1"
                                           value="<?php echo $compte['email']; ?>" type="email" required>
                                    </div>
                                    <?php if (isset($erreur)&&($erreur=="email")){ ?>
                                        <span class="help-block">L'adresse email est déjà utilisée !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="compteInputPassword1">Mot de passe</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-ios-medical"></i>
                                        </div>
                                       <?php $co=new Compte();
                                        $co1=$co->Decrypte($compte['passwd'],'1'); ?>
                                    <input class="form-control" name="password" id="compteInputPassword1" minlength="8"
                                           value="<?php echo $co1; ?>" type="password" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($erreur)&&($erreur=="password")) echo 'has-error' ?>">
                                    <label for="compteInputPassword2">Confirmation du mot de passe</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-ios-medical"></i>
                                        </div>
                                    <input class="form-control" name="valider_mot_de_passe" minlength="8"
                                           id="compteInputPassword2"
                                           value="<?php echo $co1; ?>" type="password" required>
                                    </div>
                                    <?php if (isset($erreur)&&($erreur=="password")){ ?>
                                        <span class="help-block">La confirmation du mot de passe est fausse !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="compteInputPrivilege">Choisissez le privilège</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-ios-people"></i>
                                        </div>
                                    <select class="form-control" name="account_permission" id="compteInputPrivilege"
                                            autofocus required>
                                        <option value="a" <?php if ($compte['account_permission'] == 'a') echo 'selected' ?> >
                                            Admin
                                        </option>
                                        <option value="g" <?php if ($compte['account_permission'] == 'g') echo 'selected' ?>>
                                            Gestionnaire
                                        </option>

                                    </select>
                                    </div>
                                </div>

                                <!-- /.box-body -->
                                <div class="box-footer col-lg-12">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-edit"></i> Modifier</button>

                                    <a href="index.php?action=affichage_comptes"
                                       class="btn btn-light pull-right">Retour</a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
    <?php include('view/control_sidebar.php'); ?>

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
