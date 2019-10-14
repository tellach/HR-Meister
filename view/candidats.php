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
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Liste des candidats
            </h1>
            </br>
            <a class="btn btn-success" type="button"
                    href="index.php?action=affich_ajoutcandidat"><i class="fa fa-plus"></i> Ajouter un candidat</a>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!-- My table starts here-->
            <table id="tab-conges" class="display" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Num-Identifiant</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Poste demandé</th>
                    <th>Etat</th>

                    <th class="options" style="width:30%;">Options</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Num-Identifiant </th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Poste demandé</th>
                    <th>Etat</th>
                    <th class="options" style="width:25%;"></th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                while ($candidat = $candidats->fetch()) {
                    ?>
                    <tr>
                        <td><?php echo $candidat['id'] ?></td>
                        <td><?php echo $candidat['nom'] ?></td>
                        <td><?php echo $candidat['prenom'] ?></td>
                        <td><?php echo $candidat['email'] ?></td>
                        <td><?php echo $candidat['post'];$id = $candidat['id']; ?></td>
                        <td><?php
                                if($candidat['etat']=='non_contacte') echo "Pas encore contacté";
                                if($candidat['etat']=='recontacte') echo "A recontacter";
                                if($candidat['etat']=='accepte') echo "Accepté";
                                if($candidat['etat']=='refuse') echo "Refusé";
                            ?></td>
                        <td style="width: 30%">
                            <a class="btn btn-warning" type="button" href="index.php?id=<?=$id?>&amp;action=modifier_candidat_affiche"><i class="fa fa-edit"></i> Modifier</a>

                            <a class="btn btn-primary" type="button" href="index.php?id=<?=$id?>&amp;action=info_candidat"><i class="fa fa-info"></i> info</a>

                            <?php if (($candidat['etat']=='non_contacte') or ($candidat['etat']=='recontacte')or ($candidat['etat']=='refuse'))
                            echo '<a class="btn btn-success" type="button" href="index.php?where='.'5'.'&amp;id='.$id.'&amp;action=affich_ajoutembauche"><i class="fa fa-calendar-plus-o"></i>  Ajouter entretien </a>';

                            elseif ( ($candidat['etat']=='accepte')) echo '<a class="btn btn-success" type="button" href="index.php?id='.$id.'&amp;a=5&amp;action=affich_ajoutEmploye"><i class="fa  fa-hand-o-right"></i>  Embaucher </a>'; ?>
                        </td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
            <!--My table ends here-->
        </section>

        <?php include('view/control_sidebar.php'); ?>

        <!-- REQUIRED JS SCRIPTS -->
        <?php include('view/js_links.php');?>
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