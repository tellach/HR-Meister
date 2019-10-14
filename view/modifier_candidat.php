<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php
$candidat = $candidats->fetch();
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

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Menu</li>
                <!-- Optionally, you can add icons to the links -->
                <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> <span>Accueil</span></a></li>
                <li><a href="index.php?action=list_employes"><i class="glyphicon glyphicon-folder-open"></i>
                        <span>Suivi des employés</span></a></li>

                <li class="active"><a href="index.php?action=list_candidat"><i
                                class="glyphicon glyphicon-briefcase"></i>
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
                Modification d'un candidat
            </h1>
        </section>
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire de modification des informations du candidat </h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body form-group">
                            <form action="index.php?id=<?= $_GET['id'] ?>&amp;action=modifier_candidat" method="POST"
                                  enctype="multipart/form-data" id="contact_form">

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Nom</label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                            <input class="form-control" type="text" name="nom"
                                                   value="<?php echo $candidat['nom']; ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Prénom </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-user"></i></span>
                                            <input class="form-control" type="text" name="prenom"
                                                   value="<?php echo $candidat['prenom']; ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> E-mail </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-at"></i></span>
                                            <input class="form-control" type="email" name="email"
                                                   value="<?php echo $candidat['email']; ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Numéro de téléphone </label>
                                    <div class="inputGroupContainer ">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-android-phone-portrait"></i></span>
                                            <input type="tel" class="form-control" name="tel" pattern="0[567][0-9]{8}"
                                                   value="<?php echo $candidat['tel']; ?>"/>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($error) && ($error == 'date')) echo 'has-error' ?>">
                                    <label class="control-label"> Date de naissance </label>
                                    <div class="inputGroupContainer ">
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input class="form-control" type="text" id="datepicker"
                                                   name="date_naissance"
                                                   value="<?php echo $candidat['date_naissance']; ?>"/>
                                        </div>
                                    </div> <?php if (isset($error) && ($error == "date")) { ?>
                                        <span class="help-block">La date de naissance n'est pas valide !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Poste </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-quote"></i></span>
                                            <input class="form-control" type="text" name="post"
                                                   value="<?php echo $candidat['post']; ?>"/></div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Salaire </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-social-usd"></i></span>
                                            <input class="form-control" type="number" name="salaire"
                                                   value="<?php echo $candidat['salaire']; ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label">Etat</label>
                                    <Select name="etat" id="R" class="form-control" required>
                                        <optgroup>
                                            <option value="non_contacte" <?php if ($candidat['etat'] == 'non_contacte') echo 'selected'; ?>>
                                                Pas encore contacté
                                            </option>
                                            <option value="recontacte" <?php if ($candidat['etat'] == 'recontacte') echo 'selected'; ?>>
                                                A recontacter
                                            </option>
                                            <option value="accepte"<?php if ($candidat['etat'] == 'accepte') echo 'selected'; ?>>
                                                Accepté
                                            </option>
                                            <option value="refuse"<?php if ($candidat['etat'] == 'refuse') echo 'selected'; ?>>
                                                Refusé
                                            </option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> CV </label>

                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <label class="btn btn-primary btn-file"> Parcourir

                                                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                                                <input type="file" name="cv" value="Choisisez un fichier"
                                                       onchange="previewfile()"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Commentaire </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-clipboard"></i></span>
                                            <input type="text" class="form-control" name="comment"
                                                   value="<?php echo $candidat['comment']; ?>"/>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group col-lg-12">
                                    <label class="control-label"></label>
                                    <button type="submit" class="btn btn-success" name="valider"><i
                                                class="fa fa-edit"></i> Modifier
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Main content -->
    <!-- /.content -->
</div>
<?php include('view/control_sidebar.php'); ?>

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
    })
</script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
    <?php
}
?>