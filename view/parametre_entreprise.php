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
$entreprise1 = $entreprises->fetch();
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
                <li><a href="index.php?action=affichage_comptes"><i class="glyphicon glyphicon-tags"></i> <span>Gestion des comptes</span></a>
                </li>
                <li class="active"><a href="index.php?action=modification_entreprise_afiiche"><i
                                class="glyphicon glyphicon-cog"></i> <span>Paramètres généraux</span></a>
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
                Paramètres de l'entreprise
            </h1>
            </br>
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-primary center-block">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire de modification des paramètres de l'entreprise</h3>
                        </div>

                        <div class="box-body form-group">
                            <form method="POST" action="index.php?action=modifier_entreprise"
                                  enctype="multipart/form-data">
                                <div class="form-group col-lg-12">
                                    <!--<legend> Cordonnées de l'entreprise :</legend>-->
                                    <label for="nom_entreprise" class="control-label">Nom de l'entreprise </label>
                                    <input
                                            value="<?php echo $entreprise1['nom_entreprise']; ?>" type="text"
                                            name="nom_entreprise" id="nom_entreprise" size="25" maxlength="60"
                                            class="form-control"/>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="Raison_social" class="control-label"> Raison social
                                        : </label>
                                    <input
                                            type="text"
                                            value="<?php echo $entreprise1['raison_social']; ?>"
                                            name="Raison_social"
                                            class="form-control"
                                            id="Raison social"
                                    />

                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="mail" class="control-label"> RC/Fiscal
                                    </label>
                                    <input
                                            type="text"
                                            value="<?php echo $entreprise1['RC']; ?>"
                                            name="RC"
                                            id="mail"
                                            placeholder="RC/Fiscal" class="form-control"/>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="mail" class="control-label"> Spécialité
                                    </label>
                                    <input
                                            type="text"
                                            value="<?php echo $entreprise1['specialite']; ?>"
                                            name="specialite"
                                            id="mail"
                                            placeholder="La spécialité de votre entreprise :" class="form-control"/>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="mail" class="control-label"> Adresse
                                    </label>
                                    <input
                                            type="text"
                                            value="<?php echo $entreprise1['wilaya']; ?>"
                                            name="wilaya"
                                            id="mail"
                                            placeholder="L'adresse de votre entreprise :" class="form-control"/>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="mail" class="control-label"> Adresse email de l'entrepris
                                    </label>s
                                    <input
                                            type="email"
                                            value="<?php echo $entreprise1['mail']; ?>"
                                            name="mail"
                                            id="mail"
                                            placeholder="Votre mail" class="form-control"/>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="num" class="control-label"> Numéro de téléphone
                                    </label>
                                    <input type="text"
                                           value="<?php echo $entreprise1['num']; ?>"
                                           name="num" id="num"
                                           placeholder="Numéro de téléphone de l'entreprise :" class="form-control"/>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="url" class="control-label"> Site web de l'entreprise </label>
                                    <input type="text" name="url"
                                           value="<?php echo $entreprise1['site_web']; ?>"
                                           id="url" class="form-control"/>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="msg_acceuil" class="control-label">Message d'acceuil </label>
                                    <input type="text"
                                           value="<?php echo $entreprise1['msg_acceuil']; ?>"
                                           name="msg_acceuil" class="form-control">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="nom_entreprise" class="control-label">Nom du gérant</label>
                                    <input type="text"
                                           value="<?php echo $entreprise1['nom_gerant']; ?>"
                                           name="nom_gerant"
                                           id="nom_gerant"
                                           size="25"
                                           maxlength="60"
                                           placeholder="Nom du gérant" class="form-control">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="mail" class="control-label"> Adresse email du gérant</label>
                                    <input type="email"
                                           value="<?php echo $entreprise1['mail_gerant']; ?>"
                                           name="mail_gerant"
                                           id="mail_gerant_gerant_gerant_gerant"
                                           placeholder="Mail du gérant" class="form-control">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="num" class="control-label"> Numéro de téléphone du gérant</label>
                                    <input type="text"
                                           pattern="0[567][0-9]{8}"
                                           value="<?php echo $entreprise1['num_gerant']; ?>"
                                           name="num_gerant"
                                           id="num_gerant"
                                           placeholder="Numéro de téléphone du gérant : " class="form-control">
                                </div>
                                <div class="form-group col-lg-12 <?php if (isset($error)&&($error=='extension')) echo 'has-error' ?>">
                                    <label for="num" class="control-label"> Logo de l'entreprise</label><br>
                                    <label class="btn btn-primary btn-file">Parcourir..
                                    <input type="file" name="f" value="Veuillez choisir un nouveau logo"
                                           onchange="previewfile()">
                                    <?php if (isset($error)&&($error=='extension')) { ?>
                                        <span class="help-block">Veuillez entrer une image sous format JPEG !</span>
                                    <?php } ?>
                                    </label>
                                </div>
                                <div class="box-footer col-lg-12 ">
                                    <input type="reset" class="btn btn-light pull-right" value="Effacer tout">
                                    <input type="submit" class="btn btn-success" value="Envoyer">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>



        <!-- Main content -->
        <section class="content container-fluid">

        </section>
        <!-- /.content -->
    </div>
    <?php include('view/control_sidebar.php'); ?>

    <?php include('view/js_links.php'); ?>

</body>
</html>
    <?php
}
?>
    <?php
}
?>
