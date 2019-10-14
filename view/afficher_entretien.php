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
            <?php include('view/UserAccountMenu.php') ; ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
        <?php include('view/nom_logo_entreprise.php') ; ?>


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
        </li                </li>
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
        <li><a href="index.php?action=modification_entreprise_afiiche"><i class="glyphicon glyphicon-cog"></i> <span>Paramètres généraux</span></a>
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
        Entretien annuel d'évaluation
      </h1>

    </section>

    <!-- Main content -->
    <div class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <section>
        <form action="index.php?action=telecharger_excel&amp;matricule=<?=$_GET['matricule']?>" method="POST">
        <div class="row" style="margin-left: 50px; margin-right: 50px;">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <center><h1 class="box-title"><b>1/ Evaluation du collaborateur dans son environnement de travail</b></h1></center>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><center>Evaluation de la performance</center></th>
                                <th><center>Evaluation de A à E</center></th>
                                <th><center>Commentaire</center></th>
                            </tr>
                            <tr>
                                <td>Travail en équipe</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select1">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>

                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment1"></td>
                            </tr>
                            <tr>
                                <td>Intégration/Respect avec les collègues</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select2">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>

                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment2"></td>
                            </tr>
                            <tr>
                                <td>Respect de la hiérarchie/Client</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select3">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment3"></td>
                            </tr>
                            <tr>
                                <td>Motivation , assiduité et sérieux dans le travail</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select4">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment4"></td>
                            </tr>
                            <tr>
                                <td>Ponctualité, absences et respect des Hs de travail</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select5">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment5"></td>
                            </tr>
                            <tr>
                                <td>Autres</td>
                                <td>
                                    <input class="form-control" type="text" name="autre1">
                                </td>
                                <td><input class="form-control" type="text" name="comment6"></td>
                            </tr>

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="row" style="margin-left: 50px; margin-right: 50px;">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <center><h1 class="box-title"><b>2/ Evaluation des compétences du collaborateur</b></h1></center>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><center>Evaluation de la performance</center></th>
                                <th><center>Evaluation de A à E</center></th>
                                <th><center>Commentaire</center></th>
                            </tr>
                            <tr>
                                <td>Technique :
                                    Les applications maîtrisées :
                                    Autres domaines?</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select7">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment7"></td>
                            </tr>
                            <tr>
                                <td>Fonctionnel</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select8">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>

                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment8"></td>
                            </tr>
                            <tr>
                                <td>Qualité de rédaction des documents, emails…</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select9">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment9"></td>
                            </tr>
                            <tr>
                                <td>Capacités organisationnelles</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select10">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment10"></td>
                            </tr>
                            <tr>
                                <td>les potentialités non exploitées dans le poste actuel</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select11">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment11"></td>
                            </tr>
                            <tr>
                                <td>Respect des délais de livraisons</td>
                                <td>
                                    <select class="form-control"  style="width: 100%;" name="select12">
                                        <optgroup>
                                            <option value="A">Excellent</option>
                                            <option value="B">Bien</option>
                                            <option value="C">Assez bien</option>
                                            <option value="D">Moyen</option>
                                            <option value="E">Mauvais</option>
                                        </optgroup>
                                    </select>
                                </td>
                                <td><input class="form-control" type="text" name="comment12"></td>
                            </tr>
                            <tr>
                                <td>Autres</td>
                                <td>
                                    <input class="form-control" type="text" name="autre2">
                                </td>
                                <td><input class="form-control" type="text" name="comment13"></td>
                            </tr>

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="row" style="margin-left: 50px; margin-right: 50px;">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <center><h1 class="box-title"><b>3 / Développement du collaborateur</b></h1></center>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><center>Intitulé</center></th>
                                <th><center>Propositions</center></th>
                            </tr>
                            <tr>
                                <td>Appréciation du client</td>
                                <td><input class="form-control" type="text" name="proposition1"></td>
                            </tr>
                            <tr>
                                <td>Autoappréciation</td>
                                <td><input class="form-control" type="text" name="proposition2"></td>
                            </tr>
                            <tr>
                                <td>Evolution au-delà du poste occupé</td>
                                <td><input class="form-control" type="text" name="proposition3"></td>
                            </tr>
                            <tr>
                                <td>Aspirations et orientations souhaitées</td>
                                <td><input class="form-control" type="text" name="proposition4"></td>
                            </tr>
                            <tr>
                                <td>Formations complémentaires</td>
                                <td><input class="form-control" type="text" name="proposition5"></td>
                            </tr>
                            <tr>
                                <td>Points à améliorer</td>
                                <td><input class="form-control" type="text" name="proposition6"></td>
                            </tr>
                            <tr>
                                <td>Souhaits du consultant</td>
                                <td><input class="form-control" type="text" name="proposition7"></td>
                            </tr>
                            <tr>
                                <td>Autres</td>
                                <td><input class="form-control" type="text" name="proposition8"></td>
                            </tr>

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <center><h2>Objectifs</h2></center>
        <div class="row" style="margin-left: 50px; margin-right: 50px;">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <center><h1 class="box-title"><b>Objectifs de la période actuelle</b></h1></center>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><center>Objectifs à court terme (06 mois)</center></th>
                                <th><center>Evaluation</center></th>
                                <th><center>Commentaire</center></th>
                            </tr>
                            <?php
                            $i=1;
                            while($objectif=$req1->fetch())
                            {
                                if($objectif['type']=="court terme") {
                                    $id = $objectif['id'];
                                    $matricule = $objectif['matricule'];
                                    $chaine='commentaire_court_terme'.$i;
                                    $i++; ?>

                            <tr>
                                <td><center><?php echo $objectif['objectif'];?></center></td>
                                <td><center><?php echo $objectif['Evaluation'];?></center></td>
                                <td><center><?php echo '<input type="text"  name="'.$chaine.'" value="" >';?></center></td>
                            </tr>
                            <?php }}?>
                            <tr>
                                <th><center>Objectifs à moyen terme (12 mois)</center></th>
                                <th><center>Evaluation</center></th>
                                <th><center>Commentaire</center></th>
                            </tr>
                            <?php
                            $i=1;
                            while($objectif=$req2->fetch())
                            {
                                if($objectif['type']=="moyen terme") {
                                    $id = $objectif['id'];
                                    $matricule = $objectif['matricule'];
                                    $chaine='commentaire_moyen_terme'.$i;
                                    $i++; ?>

                                    <tr>
                                        <td><center><?php echo $objectif['objectif'];?></center></td>
                                        <td><center><?php echo $objectif['Evaluation'];?></center></td>
                                        <td><center><?php echo '<input type="text"  name="'.$chaine.'" value="" >';?></center></td>
                                    </tr>
                                <?php }}?>

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="row" style="margin-left: 50px; margin-right: 50px;">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <center><h1 class="box-title"><b>Objectifs de la prochaine période</b></h1></center>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><center>Objectifs à long terme (24 mois)</center></th>
                                <th><center>Evaluation</center></th>
                                <th><center>Commentaire</center></th>
                            </tr>
                            <?php
                            $i=1;
                            while($objectif=$req3->fetch())
                            {
                                if($objectif['type']=="long terme") {
                                    $id = $objectif['id'];
                                    $matricule = $objectif['matricule'];
                                    $chaine='commentaire_long_terme'.$i;
                                    $i++; ?>

                                    <tr>
                                        <td><center><?php echo $objectif['objectif'];?></center></td>
                                        <td><center><?php echo $objectif['Evaluation'];?></center></td>
                                        <td><center><?php echo '<input type="text"  name="'.$chaine.'" value="" >';?></center></td>
                                    </tr>
                                <?php }}?>

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="row" style="margin-left: 50px; margin-right: 50px;">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <center><h1 class="box-title"><b>Commentaires libres</b></h1></center>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><center>Commentaires libres du collaborateur</center></th>
                                <th><center>Commentaires libres de l'évaluateur</center></th>
                            </tr>
                            <tr>
                                <td><textarea class="form-control" rows="8" name="comment_libre_c"></textarea></td>
                                <td><textarea class="form-control" rows="8" name="comment_libre_e"></textarea></td>
                            </tr>

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="input-group <?php if($erreur!=''){echo 'has-error';}?> " style="margin-right: 400px; margin-left: 400px;">
            <div class="input-group-btn ">
                <button type="button" class="btn btn-primary" >Score</button>
            </div>

            <!-- /btn-group -->
            <input type="text" class="form-control " name="score" required>
            <span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>

        </div>
            <div style="margin-left: 400px; margin-right: 400px;">
                <?php if ($erreur!='') { ?>
                    <span class="help-block input-group-addon" style="margin-left: 20px; color: red">Le score doit être compris entre 0 et 20 !</span>
                <?php } ?>
            </div>


            <button type="submit" name="valider" class="btn btn-primary" style="margin-left: 70px;">Valider</button>
        <a href="index.php?id=<?=$id_employe?>&amp;action=info_employe" class="btn btn-light pull-right" style="margin-right: 50px;">Retour</a>
        </form>

    </section>
    <!-- /.content -->

  </div>
      <?php include('view/control_sidebar.php'); ?>

<!-- REQUIRED JS SCRIPTS -->
      <?php include('view/control_sidebar.php'); ?>

      <?php include('view/js_links.php'); ?>


</body>
</html>
    <?php
}
?>