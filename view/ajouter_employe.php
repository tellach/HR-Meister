<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php if (isset($a) && ($a == 5)) $donn = $donna->fetch();
if (isset($a) && ($a == 5)) $b = $donn['id']; else $b = 0; ?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <?php include('view/css_links.php'); ?>
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
    </style>
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
                Ajout d'un employé
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire d'ajout d'un nouveau employé</h3>
                        </div>
                        <div class="box-body form-group">
                            <form action="index.php?id=<?= $b ?>&amp;a=5&amp;action=ajouter_employe" method="POST"
                                  enctype="multipart/form-data"
                                  role="form">

                                <div class="form-group col-lg-12 <?php if (($errors['exists'] == 1) && isset($errors['matricule']) && ($errors['matricule'] == 1)) echo 'has-error' ?>">
                                    <label for="matricule" class="control-label"> Matricule </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-pound"></i>
                                        </div>
                                        <input type="number"
                                               id="<?php if (($errors['exists'] == 1) && isset($errors['matricule']) && ($errors['matricule'] == 1)) echo 'inputError'; ?>"
                                               name="matricule" class="form-control">
                                    </div>

                                    <?php if (($errors['exists'] == 1) && isset($errors['matricule']) && ($errors['matricule'] == 1)) { ?>
                                        <span class="help-block">Le matricule existe déjà ! </span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="name" class="control-label"> Nom </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-person"></i>
                                        </div>
                                        <input type="text" id="name" name="nom" class="form-control" required
                                               value="<?php if (isset($a) && ($a == 5)) echo $donn['nom']; ?>">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="fname" class="control-label"> Prénom </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-person"></i>
                                        </div>
                                        <input type="text" id="fname" name="prenom" class="form-control" required
                                               value="<?php if (isset($a) && ($a == 5)) echo $donn['prenom']; ?>">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if (($errors['exists'] == 1) && isset($errors['date_naissance']) && ($errors['date_naissance'] == 1)) echo 'has-error' ?>">
                                    <label for="datapicker" class="control-label"> Date de naissance </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="datepicker" name="date_naissance" class="form-control"
                                               required
                                               value="<?php if (isset($a) && ($a == 5)) echo $donn['date_naissance']; ?>">
                                    </div>
                                    <?php if (($errors['exists'] == 1) && isset($errors['date_naissance']) && ($errors['date_naissance'] == 1)) { ?>
                                        <span class="help-block">La date de naissance n'est pas valide !</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="" class="control-label"> Lieu de naissance </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-android-compass"></i>
                                        </div>
                                        <input type="text" id="" name="lieu" class="form-control" value="">
                                    </div>
                                </div>


                                <div class="form-group col-lg-12">
                                    <label for="fam" class="control-label"> Situation familiale </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-heart"></i>
                                        </div>
                                        <select name="situation_fam" id="fam" class="form-control">
                                            <option value="Marié(e)">Marié(e)</option>
                                            <option value="Divorcé(e)">Divorcé(e)</option>
                                            <option value="Célibataire">Célibataire</option>
                                            <option value="Veuf(ve)">Veuf(ve)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="adress"> Adresse </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-home"></i>
                                        </div>
                                        <input type="text" id="adress" name="adresse" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="tel" class="control-label">Numéro de téléphone </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-android-phone-portrait"></i>
                                        </div>
                                        <input type="text" id="tel" name="tel" class="form-control"
                                               pattern="0[567][0-9]{8}" required
                                               value="<?php if (isset($a) && ($a == 5)) echo $donn['tel']; ?>">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="mail" class="control-label"> Adresse E-mail </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-at"></i>
                                        </div>
                                        <input type="email" id="mail" name="email" class="form-control" required
                                               value="<?php if (isset($a) && ($a == 5)) echo $donn['email']; ?>">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if (($errors['exists'] == 1) && isset($errors['date_embauche']) && ($errors['date_embauche'] == 1)) echo 'has-error' ?>">
                                    <label for="datepicker2" class="control-label">Date d'embauche</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="datepicker2" name="date_embauche" class="form-control"
                                               required>
                                    </div>
                                    <?php if (($errors['exists'] == 1) && isset($errors['date_embauche']) && ($errors['date_embauche'] == 1)) { ?>
                                        <span class="help-block">La date d'embauche n'est pas valide ! </span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="poste" class="control-label"> Poste occupé</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-quote"></i>
                                        </div>
                                        <input type="text" id="poste" name="post" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="respo" class="control-label"> Responsable </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-bookmark"></i>
                                        </div>
                                        <input type="number" id="respo" name="respo" class="form-control" value="0"
                                               placeholder="Pas de responsable">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="salaire" class="control-label"> Salaire </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-social-usd"></i>
                                        </div>
                                        <input type="number" id="salaire" name="salaire" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="status" class="control-label"> Statut </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-battery-low"></i>
                                        </div>
                                        <select name="statut" id="status" class="form-control">
                                            <option value="Actif">Actif</option>
                                            <option value="Désactivé">Inactif</option>
                                            <option value="Retraite">Retraité</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="projet" class="control-label"> Projet </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-social-buffer"></i>
                                        </div>
                                        <input type="text" id="projet" name="projet" class="form-control" required>
                                    </div>
                                </div>


                                <div class="form-group col-lg-12">
                                    <label for="assure" class="control-label">Assurance </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-ios-compose"></i>
                                        </div>
                                        <input type="text" id="assure" name="assurence" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="social" class="control-label"> Numéro d'immatriculation sociale </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-ios-bookmarks"></i>
                                        </div>
                                        <input type="text" id="social" name="num_social" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12" hidden>
                                    <label for="contrat" class="control-label">Contrat </label>

                                    <input type="hidden" id="contrat" name="MAX_FILE_SIZE" value="100000"
                                           class="form-control">
                                    <input type="file" name="contrat" value="Choisisez un fichier"
                                           onchange="previewfile()"/>
                                </div>

                                <div class="form-group col-lg-12 <?php if (($errors['exists'] == 1) && isset($errors['file']) && ($errors['file'] == 1)) echo 'has-error' ?>">
                                    <label for="cv" class="control-label">CV de l'employé </label><br>

                                    <label class="btn btn-primary btn-file"> Parcourir
                                        <input type="hidden" id="cv" name="MAX_FILE_SIZE" value="100000"
                                               class="form-control">
                                        <input type="file" name="cv" value="" onchange="previewfile()" required
                                               value="<?php if (isset($a) && ($a == 5)) echo $donn['cv']; else echo '/'; ?>">
                                    </label>
                                    <?php if (($errors['exists'] == 1) && isset($errors['file']) && ($errors['file'] == 1)) { ?>
                                        <span class="help-block">L'extension du fichier envoyé n'est pas valide ! Veuillez entrer un fichier .pdf ou .docx</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12" hidden>
                                    <label for="conge" class="control-label">Statut </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="number" id="conge" name="conge" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12" hidden>
                                    <label for="demission" class="control-label">Date de démission </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="demission" name="date_demission" class="form-control"
                                               value="2050-04-03">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12" hidden>
                                    <label for="reste" class="control-label"> Nombre de jours de congé restants </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-calendar"></i>
                                        </div>
                                        <input type="text" id="reste" name="conge" class="form-control" value="1">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="reste" class="control-label"> Nombre de jours de congé restants </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-calendar"></i>
                                        </div>
                                        <input type="number" id="reste" name="reste_conge" class="form-control"
                                               value="30">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="bank" class="control-label"> Coordonnées bancaires</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-card"></i>
                                        </div>
                                        <input type="text" id="bank" name="coord_bancaire" class="form-control"
                                               required>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="comment" class="control-label">Commentaire</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="ion-clipboard"></i>
                                        </div>
                                        <input type="text" id="comment" name="comment" class="form-control"
                                               value="<?php if (isset($a) && ($a == 5)) echo $donn['comment']; else echo '/'; ?>">
                                    </div>
                                </div>

                                <div class="box-footer col-lg-12">
                                    <button type="submit" class="btn btn-success" name="valider"><span
                                                class="glyphicon glyphicon-send"></span> Valider
                                    </button>
                                    <a href="index.php?action=list_employes" class="btn btn-light pull-right">Retour</a>
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

    <?php include('view/js_links.php'); ?>

    <!-- Forms Elements' initializations -->
    <script>
        $(function () {
            //Date Picker
            $('#datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });
            $('#datepicker1').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });
            $('#datepicker2').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });

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