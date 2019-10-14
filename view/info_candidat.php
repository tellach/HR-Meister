<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php $candidat=$candidats->fetch();


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
      <?php include('view/UserAccountMenu.php') ; ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
        <?php include('view/nom_logo_entreprise.php') ; ?>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> <span>Accueil</span></a></li>
            <li><a href="index.php?action=list_employes"><i class="glyphicon glyphicon-folder-open"></i>
                    <span>Suivi des employés</span></a></li>
            
            <li class="active"><a href="index.php?action=list_candidat"><i class="glyphicon glyphicon-briefcase"></i>
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
        Suivi des recrutements
      </h1>
    </section>
      <section class="content container-fluid">
          <h2><small>Références</small></h2>

          <a class="btn btn-success" style="margin-left: 50px;" type="button" href="#">le CV</a>

          <a class="btn btn-success" style="margin-left: 250px;" type="button" href="index.php?where=<?=0?>&amp;matricule=<?=$candidat['id']?>&amp;action=liste_entretiens_candidat">Liste des entretiens</a>

          <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title">Les informations du condidat <?php echo $candidat['nom'].' '.$candidat['prenom']; ?></h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                    <td>Nom</td>
                    <td><?php echo $candidat['nom'];?></td>
                </tr>
                  <tr>
                      <td>Prénom</td>
                      <td><?php echo $candidat['prenom'] ?></td>
                  </tr>
                  <tr>
                      <td>Date de naissance</td>
                      <td><?php echo $candidat['date_naissance'];?></td>
                  </tr>
                  <tr>
                      <td>Poste demandé</td>
                      <td><?php echo $candidat['post'];?></td>
                  </tr>


                  <tr>
                      <td>Salaire demandé</td>
                      <td><?php echo $candidat['salaire'];?>DA</td>
                  </tr>



                  <tr>
                      <td>Numéro de téléphone</td>
                      <td><?php echo $candidat['tel'];?></td>
                  </tr>
                  <tr>
                      <td>Email</td>
                      <td><?php echo $candidat['email'];?></td>
                  </tr>

                  <tr>
                      <td>Commentaire</td>
                      <td><?php echo $candidat['comment'];?></td>
                  </tr>


              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <a href="index.php?action=list_candidat" class="btn btn-light pull-right">Retour</a>
          <!-- /.box -->
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
    <?php include('view/control_sidebar.php'); ?>

    <!-- REQUIRED JS SCRIPTS -->
    <?php include('view/js_links.php');?>
</body>
</html>
    <?php
}
?>