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
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Historique des congés de
                <?php
                    $e=$emp->fetch();
                    echo $e['nom'].' '.$e['prenom'];
                ?>
            </h1>
            </br>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <!-- My table starts here-->
            <table id="tab-conges" class="display" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Type du congé</th>
                    <th class="options" style="width:25%;">Options</th>

                </tr>
                </thead>

                <tfoot>
                <tr>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Type du congé</th>
                    <th class="options" style="width:25%;"></th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                while ($conge=$conges->fetch())
                {
                    ?>
                    <tr>
                        <td><?php echo $conge['date_debut']?></td>
                        <td><?php echo $conge['date_fin']?></td>
                        <td><?php if ($conge['type_conge']==1) echo 'Annuel'; elseif ($conge['type_conge']==2) echo 'Maladie';elseif ($conge['type_conge']==3) echo 'Sans solde';  ?></td>
                        <td><a class="btn btn-success" type="button"
                               href="index.php?id=<?=$conge['id_conge']?>&amp;action=genererTitreConge"><i class="fa fa-save"></i> Générer titre des congés</a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <!--My table ends here-->
        </section>
        <?php include('view/control_sidebar.php'); ?>

        <!-- REQUIRED JS SCRIPTS -->
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