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
    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }

        tfoot {
            display: table-header-group;
        }
    </style>
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
                <li class="active"><a href="index.php?action=affichage_comptes"><i class="glyphicon glyphicon-tags"></i> <span>Gestion des comptes</span></a>
                </li>
                <li><a href="index.php?action=modification_entreprise_afiiche"><i class="glyphicon glyphicon-cog"></i> <span>Paramètres généraux</span></a>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Liste des comptes
            </h1>
            </br>
            <a  type="button" class="btn btn-success" <?php if($_SESSION['account_permission'] == 'G') echo ' data-toggle="modal" data-target="#modal-danger" href="#" '; else echo 'href="index.php?action=affich_ajoutCompte"'?>><i class="fa fa-plus"></i> Ajouter un compte</a>

        </section>

        <div class="modal modal-danger fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Accès réfusé</h4>
                    </div>
                    <div class="modal-body">
                        <p>Vous n'avez pas le droit d'accéder à cette page </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <!-- My table starts here-->
            <table id="tab-conges" class="display" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Username</th>
                    <th>Privilèges</th>
                    <th class="options" style="width:25%;">Options</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Username</th>
                    <th>Privilèges</th>
                    <th class="options" style="width:25%;"></th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                while ($compte = $comptes->fetch()) {
                    ?>
                    <tr>
                        <td><?php echo $compte['nom'] ?></td>
                        <td><?php echo $compte['prenom'] ?></td>
                        <td><?php echo $compte['username'] ?></td>
                        <td><?php if ($compte["account_permission"] == 'a') {
                                echo 'Admin';
                            } elseif ($compte["account_permission"] == 'g') {
                                echo 'Gestionnaire';
                            }
                            $id = $compte['id'];
                            ?></td>
                        <td><a class="btn btn-warning" type="button"
                                <?php if($_SESSION['account_permission'] == 'G') echo ' data-toggle="modal" data-target="#modal-danger" href="#" '; else echo 'href="index.php?id=' . $id . '&amp;action=affiche_compte_modifier"'?>
                            ><i class="fa fa-edit"></i> Modifier</a>
                            <a class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-danger<?php  if($_SESSION['account_permission'] != 'G') echo $id; ?>"><i class="fa fa-remove"></i> Supprimer</a>
                            <div class="modal modal-danger fade" id="modal-danger<?php echo $id; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Confirmation de la suppression</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Etes-vous sûr de vouloir supprimer ce compte ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Annuler</button>
                                            <a type="button" class="btn btn-outline" href="<?php echo 'index.php?id=' . $id . '&amp;action=supprimer_compte' ?>">Supprimer</a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
            <!--My table ends here-->
        </section>
        <?php include('view/control_sidebar.php'); ?>

        <!-- Main Footer -->
        <!--<footer class="main-footer">
          <div class="pull-right hidden-xs">
            Anything you want
          </div>
          <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
        </footer>-->

        <!-- Control Sidebar -->
        <!--<aside class="control-sidebar control-sidebar-dark">

          <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="control-sidebar-home-tab">
              <h3 class="control-sidebar-heading">Recent Activity</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:;">
                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                      <p>Will be 23 on April 24th</p>
                    </div>
                  </a>
                </li>
              </ul>
              <h3 class="control-sidebar-heading">Tasks Progress</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:;">
                    <h4 class="control-sidebar-subheading">
                      Custom Template Design
                      <span class="pull-right-container">
                          <span class="label label-danger pull-right">70%</span>
                        </span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <div class="tab-pane" id="control-sidebar-settings-tab">
              <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Report panel usage
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Some information about this general settings option
                  </p>
                </div>
              </form>
            </div>
          </div>
        </aside>-->

        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <!--<div class="control-sidebar-bg"></div>
        </div>-->
        <!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 3 -->
        <?php include('view/js_links.php'); ?>


        <script>
            $(document).ready(function () {
                // Setup - add a text input to each footer cell
                $('#tab-conges tfoot th:not(.options)').each(function () {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="Rech ' + title + '" />');
                });

                // DataTable
                var table = $('#tab-conges').DataTable({
                    "language": {
                        "lengthMenu": "Afficher _MENU_ éléments par page",
                        "zeroRecords": "Aucun résultat ",
                        "info": "Affichage de la page _PAGE_ de _PAGES_",
                        "infoEmpty": "Aucun élément trouvé",
                        "infoFiltered": "(filtré du total de _MAX_ éléments)",
                        "paginate": {
                            "first":      "Premier",
                            "last":       "Dernier",
                            "next":       "Suivant",
                            "previous":   "Précédent"
                        },
                        "search": "Recherche :"
                    }
                });

                // Apply the search
                table.columns().every(function () {
                    var that = this;

                    $('input', this.footer()).on('keyup change', function () {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });

            });
            /*$(document).ready(function() {
                $('#tab-conges').DataTable( {
                    "language": {
                        "lengthMenu": "Display _MENU_ records per page",
                        "zeroRecords": "Aucun résultat ",
                        "info": "Affichage de la page _PAGE_ de _PAGES_",
                        "infoEmpty": "Aucun enregistrement trouvé",
                        "infoFiltered": "(filtré du total de _MAX_ enregistrement)"
                    }
                } );
            } );*/
        </script>
</body>
</html>
    <?php
}
?>