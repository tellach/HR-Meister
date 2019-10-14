<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php
$employe = $employes->fetch();
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
                Modification d'un employé
            </h1>
        </section>
        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row ">
                <div class="col-md-10">
                    <div class="box box-primary center-block" style="width:100%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Formulaire de modification des information
                                de <?php echo $employe['nom'] . ' ' . $employe['prenom']; ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body form-group">
                            <!-- form start -->
                            <form action="index.php?id=<?= $_GET['id'] ?>&amp;action=modifier_employe" method="POST"
                                  enctype="multipart/form-data" role="form" id="contact_form">
                                <div class="form-group col-lg-12 <?php if (($errors['exists'] == 1) && isset($errors['matricule']) && ($errors['matricule'] == 1)) echo 'has-error' ?>">
                                    <label class="control-label"> Matricule </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-pound"></i></span>
                                            <input type="number" class="form-control" name="matricule"
                                                   value="<?php echo $employe['matricule']; ?>"/>
                                        </div>
                                    </div>
                                    <?php if (($errors['exists'] == 1) && isset($errors['matricule']) && ($errors['matricule'] == 1)) { ?>
                                        <span class="help-block">Le matricule existe déjà ! Veuillez entrer un matricule valide</span>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Nom </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-person"></i></span>
                                            <input class="form-control" type="text" name="nom"
                                                   value="<?php echo $employe['nom']; ?>"/>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Prénom </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-person"></i></span>
                                            <input class="form-control" type="text" name="prenom"
                                                   value="<?php echo $employe['prenom']; ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if (($errors['exists'] == 1) && isset($errors['date_naissance']) && ($errors['date_naissance'] == 1)) echo 'has-error' ?>">
                                    <label class="control-label"> Date de naissance </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-calendar"></i></span>
                                            <input class="form-control" type="text" id="datepicker"
                                                   name="date_naissance"
                                                   value="<?php echo $employe['date_naissance']; ?>"/>
                                        </div>
                                    </div>
                                    <?php if (($errors['exists'] == 1) && isset($errors['date_naissance']) && ($errors['date_naissance'] == 1)) { ?>
                                        <span class="help-block">La date de naissance n'est pas valide ! Veuillez entrer une date valide</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Lieu de naissance </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-android-compass"></i></span>
                                            <input class="form-control" type="text" name="lieu"
                                                   value="<?php echo $employe['lieu_naissance']; ?>"/></div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Situation familiale </label>
                                    <div class="selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-heart"></i></span>
                                            <select name="situation_fam" class="form-control selectpicker">
                                                <option value="Marié(e)" <?php if ($employe['situation_fam'] == "Marié(e)") echo "selected"; ?> >
                                                    Marié(e)
                                                </option>
                                                <option value="Divorcé(e)" <?php if ($employe['situation_fam'] == "Divorcé(e)") echo "selected"; ?>>
                                                    Divorcé(e)
                                                </option>
                                                <option value="Célibataire" <?php if ($employe['situation_fam'] == "Célibataire") echo "selected"; ?>>
                                                    Célibataire
                                                </option>
                                                <option value="Veuf(ve)" <?php if ($employe['situation_fam'] == "Veuf(ve)") echo "selected"; ?>>
                                                    Veuf(ve)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Adresse </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-home"></i></span>
                                            <input type="text" class="form-control" name="adresse"
                                                   value="<?php echo $employe['adresse']; ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Numéro de téléphone </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-android-phone-portrait"></i></span>
                                            <input type="text" class="form-control" name="tel" pattern="0[567][0-9]{8}"
                                                   value="<?php echo $employe['tel']; ?>"/>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> E-mail </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-at"></i></span>
                                            <input type="email" class="form-control" name="email"
                                                   value="<?php echo $employe['email']; ?>"/>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 <?php if (($errors['exists'] == 1) && isset($errors['date_embauche']) && ($errors['date_embauche'] == 1)) echo 'has-error' ?>">
                                    <label class="control-label"> Date d'embauche</label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-calendar"></i></span>
                                            <input class="form-control" type="date" name="date_embauche"
                                                   value="<?php echo $employe['date_embauche']; ?>"/>
                                        </div>
                                    </div>
                                    <?php if (($errors['exists'] == 1) && isset($errors['date_embauche']) && ($errors['date_embauche'] == 1)) { ?>
                                        <span class="help-block">La date d'embauche n'est pas valide ! Veuillez entrer une date valide</span>
                                    <?php } ?>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Poste occupé</label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-quote"></i></span>
                                            <input class="form-control" type="text" name="post"
                                                   value="<?php echo $employe['post']; ?>"/></div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Responsable </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-bookmark"></i></span>
                                            <input class="form-control" type="text" name="respo"
                                                   value="<?php echo $employe['respo']; ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Salaire </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-social-usd"></i></span>
                                            <input class="form-control" type="text" name="salaire"
                                                   value="<?php echo $employe['salaire']; ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Statut </label>
                                    <div class="selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-battery-low"></i></span>
                                            <select name="statut" class="form-control selectpicker">
                                                <option value="Actif">Actif</option>
                                                <option value="Désactivé">Désactivé</option>
                                                <option value="Retraite">Retraite</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Projet </label>

                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-social-buffer"></i></span>
                                            <input class="form-control" type="text" name="projet"
                                                   value="<?php echo $employe['projet']; ?>"/></div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Assurance </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-ios-compose"></i></span>
                                            <input class="form-control" type="text" name="assurence"
                                                   value="<?php echo $employe['assurence']; ?>"/></div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Numéro d'immatriculation social </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-ios-bookmarks"></i></span>
                                            <input class="form-control" type="text" name="num_social"
                                                   value="<?php echo $employe['num_social']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Contrat </label>

                                    <div class="inputGroupContainer">
                                        <div class="input-group">

                                            <label class="btn btn-primary btn-file"> Parcourir
                                                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                                                <input type="file" name="contrat" value="Choisisez un fichier"
                                                       onchange="previewfile()"/>
                                            </label>
                                        </div>
                                    </div>
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
                                    <label class="control-label"> Date de dimission </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-calendar"></i></span>
                                            <input class="form-control" type="date" name="date_demission"
                                                   value="<?php echo $employe['date_demission']; ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12" hidden>
                                    <label class="control-label"> Congé </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-fire"></i></span>
                                            <input type="text" class="form-control" name="conge"
                                                   value="<?php echo $employe['conge']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Nombre de jours congé restants </label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-calendar"></i></span>
                                            <input type="text" class="form-control" name="reste_conge"
                                                   value="<?php echo $employe['reste_conge']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Coordonnées bancaires</label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-card"></i></span>
                                            <input type="text" class="form-control" name="coord_bancaire"
                                                   value="<?php echo $employe['coord_bancaire']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="control-label"> Commentaire</label>
                                    <div class="inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="ion-clipboard"></i></span>
                                            <input type="text" class="form-control" name="comment"
                                                   value="<?php echo $employe['comment']; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="control-label"></label>
                                    <button type="submit" class="btn btn-success" name="valider"><span
                                                class="glyphicon glyphicon-send"></span>Valider
                                    </button>
                                    <a href="index.php?action=list_employes" class="btn btn-light pull-right">Retour</a>

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

</body>
</html>
    <?php
}
?>
