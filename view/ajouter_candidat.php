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
                Ajout d'un candidat
            </h1>
        </section>

        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire d'ajout d'un nouveau candidat</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body form-group">
                            <form action="index.php?action=ajouter_candidat" method="POST" enctype="multipart/form-data"
                                  role="form">
                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Nom *</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-person"></i>
                                        </div>
                                        <input type="text" class="form-control" name="nom" required/>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Prénom *</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-person"></i>
                                        </div>
                                        <input type="text" class="form-control" name="prenom" required/>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if (isset($error) && ($error == 'date')) echo 'has-error' ?>">
                                    <label for="" class="control-label">Date de naissance *</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="datepicker" class="form-control" name="date_naissance"
                                               required/>
                                    </div> <?php if (isset($error) && ($error == "date")) { ?>
                                        <span class="help-block">La date de naissance n'est pas valide !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Poste </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-quote"></i>
                                        </div>
                                        <input type="text" class="form-control" name="post" required value="....."/>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Salaire désiré </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-social-usd"></i>
                                        </div>
                                        <input type="number" class="form-control" name="salaire" required value="00"/>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> CV </label><br>
                                    <label class="btn btn-primary btn-file"> Parcourir

                                        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                                        <input type="file" name="cv" value="Choisisez un fichier"
                                               onchange="previewfile()"/>
                                    </label>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Numéro de téléphone * </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-android-phone-portrait"></i>
                                        </div>
                                        <input type="tel" class="form-control" name="tel" pattern="0[567][0-9]{8}"
                                               required/>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> E-mail * </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-at"></i>
                                        </div>
                                        <input type="email" class="form-control" name="email" required/>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label">Etat</label>
                                    <Select name="etat" id="R" class="form-control" required>
                                        <optgroup>
                                            <option value="non_contacte"> Pas encore contacté</option>
                                            <option value="recontacte"> A recontacter</option>
                                            <option value="accepte"> Accepté</option>
                                            <option value="refuse"> Refusé</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Commentaire</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-clipboard"></i>
                                        </div>
                                        <input type="text" class="form-control" name="comment" required value="....."/>
                                    </div>
                                </div>

                                <div class="box-footer col-lg-12">
                                    <input type="reset" class="btn btn-light pull-right" value="Effacer tout">
                                    <button type="submit" class=" btn btn-success" name="valider"><span
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

    <!-- Main content
    <section class="content container-fluid">
      <div class="box box-primary center-block" style="width:500px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulaire d'ajout d'un nouveau candidat</h3>
                </div>

          <form action="../index.php?action=ajouter_candidat" method="POST" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label form="compteInputNom">Nom * </label>
                            <input class="form-control" placeholder="Entrer le nom" type="text" required="required" name="nom">
                        </div>
                        <div class="form-group">
                            <label form="compteInputPrenom">Prénom * </label>
                            <input class="form-control" placeholder="Entrer le prénom" type="text" required="required" name="prenom">
                        </div>
                        <div class="form-group">
                            <label for="compteInputPassword2">Numéro de téléphone * </label>
                            <input class="form-control" placeholder="Entrer le numéro de téléphone" type="text" required="required" name="tel">
                        </div>
                        <div class="form-group">
                            <label for="compteInputPassword2">Email * </label>
                            <input class="form-control" placeholder="Entrer l'email" type="email" required="required" name="mail">
                        </div>
                        <div class="form-group">
                            <label form="compteInputPoste">Poste * </label>
                            <input class="form-control" placeholder="Entrer le Poste" type="text" required="required" name="post">
                        </div>

                        <div class="form-group">
                            <label for="compteInputPassword1">Salaire désiré * </label>
                            <input class="form-control" placeholder="Entrer le salaire désiré" type="text" required="required" name="salaire">
                        </div>

                        <div class="form-group">
                            <label for="compteInputPassword1">Commentaire</label>
                            <input class="form-control" placeholder="Entrer un commentaire" type="text" name="comment">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">CV * </label>
                          <input type="file" id="exampleInputFile" required="required" name="cv">
                        </div>
                        <div class="box-header with-border">
                          <h3 class="box-title">Remarque : Les champs marqués par un * sont obligatoires</h3>
                        </div>

                    <div class="box-footer" style="padding-top:0;">

                        </br>
                        <p> <input type="reset" value="effacer"><br>
                            <input type="submit" name="valider">
                           <button name="valider" type="submit" class="btn btn-success">Ajouter</button>

                        <a href="index.php?action=list_candidat" class="btn btn-light pull-right">Retour</a>
                    </div>
                </form>
            </div>

    </section>

  </div> -->

    <?php include('view/control_sidebar.php'); ?>
    <?php include('view/js_links.php'); ?>

    <!-- Page script -->
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