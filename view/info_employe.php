<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php
$employe=$employes->fetch();
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
        Suivi des employés
      </h1>
    </section>
      <?php $matricule= $employe['matricule'];?>
      <!-- Main content -->
    <section class="content container-fluid">
      <h2><small>Options</small></h2>
        <br>
        <a class="btn btn-success" style="margin-left: 20px;" type="button" href="index.php?id=<?=$_GET['id']?>&amp;action=historique_salaire"><i class="fa fa-history"></i> Historique des salaires</a>
        <a class="btn btn-success" style="margin-left: 40px;" type="button" href="index.php?action=list_conge_employe&amp;matricule=<?=$matricule?>"><i class="fa fa-list"></i> Liste des congés</a>

        <br><br>


        <div class="box-body">

            <div class="margin">
                <div class="btn-group">
                    <button type="button" class="btn btn-warning">Références</button>
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?id=<?=$_GET['id']?>&amp;action=genererAttestation">Générer attestation de travail</a></li>
                        <li><a href="index.php?id=<?=$_GET['id']?>&amp;action=genererCertificat">Générer certificat de travail</a></li>
                        <li><a href="<?php echo $employe['cv'];?>">Importer le CV</a></li>
                    </ul>
                </div>
                <?php if($employe['statut']=='Actif'){ ?>
                <div class="btn-group" style="margin-left: 100px;">
                    <button type="button" class="btn btn-primary">Entretiens d'évaluation</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?action=affichage_objectifs&amp;matricule=<?=$matricule?>">Liste des objectifs</a></li>
                        <li><a href="index.php?matricule=<?=$matricule?>&amp;action=affichage_entretien">Ajouter un entretien</a></li>
                        <li><a href="index.php?matricule=<?=$matricule?>&amp;action=affichage_entretiens">Afficher les entretiens</a></li>
                    </ul>
                </div>
                <?php } ?>
                <div class="btn-group" style="margin-left: 100px;">
                    <button type="button" class="btn btn-danger">Contrat de travail</button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?id=<?=$_GET['id']?>&amp;action=genererContrat">Générer un model du contrat</a></li>
                        <?php if ($employe['contrat']==''){ ?><li><a href="index.php?id=<?=$_GET['id']?>&amp;action=contrat_input">Ajouter un contrat signé</a></li><?php }
                        else { ?><li><a href="<?php echo $employe['contrat'];?>" download="">Importer le contrat signé</a></li><?php }?>
                    </ul>
                </div>
            </div>


        </div>











        <h3 class="box-title">Les informations de <?php echo $employe['nom'].' '.$employe['prenom']; ?></h3>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <td>Matricule</td>
                  <td><?php echo $employe['matricule']; ?></td>
                </tr>
                <tr>
                  <td>Nom</td>
                  <td><?php echo $employe['nom']; ?></td>
                </tr>
                <tr>
                  <td>Prénom</td>
                  <td><?php echo $employe['prenom']; ?></td>
                </tr>
                <tr>
                  <td>Date de naissance</td>
                  <td><?php echo $employe['date_naissance'];?></td>
                </tr>
                  <tr>
                      <td>Lieu de naissence</td>
                      <td><?php echo $employe['lieu_naissance'];?></td>
                  </tr>
                  <tr>
                      <td>Situatio familiale</td>
                      <td><?php echo $employe['situation_fam'];?></td>
                  </tr>
                <tr>
                  <td>Poste</td>
                  <td><?php echo $employe['post'];?></td>
                </tr>
                <tr>
                  <td>Résponsable hiérarchique</td>
                  <?php if (isset($employe333))
                  {?>
                  <td><?php echo $employe333['nom'].' '.$employe333['prenom'] ?></td>
                  <?php } ?>
                </tr>
                <tr>
                  <td>Date d'embauche</td>
                  <td><?php echo $employe['date_embauche'];?></td>
                </tr>
                <tr>
                  <td>Salaire</td>
                  <td><?php echo $employe['salaire'];?>DA</td>
                </tr>
                <tr>
                  <td>Projet</td>
                  <td><?php echo $employe['projet'];?></td>
                </tr>
                <tr>
                  <td>Numéro d'immatriculation sociale</td>
                  <td><?php echo $employe['num_social'];?></td>
                </tr>
                <tr>
                  <td>Adresse</td>
                  <td><?php echo $employe['adresse'];?></td>
                </tr>
                <tr>
                  <td>Numéro de téléphone</td>
                  <td><?php echo $employe['tel'];?></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><?php echo $employe['email'];?></td>
                </tr>
                <tr>
                  <td>Coordonnés bancaires</td>
                  <td><?php echo $employe['coord_bancaire'];?></td>
                </tr>
                <tr>
                  <td>Commentaire</td>
                  <td><?php echo $employe['comment'];?></td>
                </tr>
                <tr>
                  <td>Statut</td>
                  <td><?php echo $employe['statut'];?></td>
                </tr>
                  <?php if($employe['statut']=='Inactif'){ ?>
                  <tr>
                  <td>Date de démission</td>
                  <td><?php echo $employe['date_demission'];?></td>
                </tr>
                  <?php } ?>
                  <?php if($employe['statut']=='Actif'){ ?>
                      <tr>
                          <td>Nombre de jours de congé restants</td>
                          <td><?php echo $employe['reste_conge'];?></td>
                      </tr>
                  <?php } ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <a href="index.php?action=list_employes" class="btn btn-light pull-right">Retour</a>
          <!-- /.box -->
        </div>
      </div>

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