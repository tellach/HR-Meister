<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php $embauche = $embauches;
$GLOBALS['n'] = $embauche['id'];

?><!DOCTYPE html>
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
                <li class="treeview active">
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
                Calendrier des entretiens
            </h1>
        </section>
        <section class="content container-fluid">
            <!-- Main content -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <center><h1 class="box-title"><b>Les informations de cet entretien : </b></h1></center>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <td> Nom</td>
                                    <td><?php echo $embauche['nom']; ?></td>
                                </tr>
                                <tr>
                                    <td>Prénom</td>
                                    <td><?php echo $embauche['prenom']; ?></td>
                                </tr>
                                <tr>
                                    <td>Date de l'entretien</td>
                                    <td><?php echo $embauche['datee']; ?></td>
                                </tr>
                                <tr>
                                    <td>Poste</td>
                                    <td><?php echo $embauche['poste']; ?></td>
                                </tr>
                                <tr>
                                    <td>Salaire désiré</td>
                                    <td><?php echo $embauche['salaire']; ?></td>
                                </tr>
                                <tr>
                                    <td>Expérience</td>
                                    <td><?php echo $embauche['note']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    </br>
                    <div class="row" style="margin-left: 50px; margin-right: 50px;">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <center><h1 class="box-title"><b>Liste des questions réponses </b></h1></center>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <th>
                                                <center>Questions</center>
                                            </th>
                                            <th>
                                                <center>Réponses</center>
                                            </th>
                                            <th>
                                                <center>Options</center>
                                            </th>
                                        </tr>

                                        <?php
                                        while ($question = $questions->fetch()) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $question['question'] ?></center>
                                                </td>
                                                <td>
                                                    <center><?php $id = $question['id'];
                                                        echo $question['reponse'] ?></center>
                                                </td>
                                                <td style="width: 240px;">
                                                    <center>
                                                        <a href="index.php?emb=<?= $embauche['id'] ?>&amp;where=<?= $where ?>&amp;id=<?= $id ?>&amp;action=modifier_question_affiche"><i
                                                                    class="btn btn-light " style="font-style: normal;"> Modifier </a>
                                                        <a href="index.php?where=<?= $where ?>&amp;emb=<?= $embauche['id'] ?>&amp;id=<?= $id ?>&amp;action=supprimer_question"><i
                                                                    class="btn btn-light " style="font-style: normal;"> Supprimer </a>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php
                                        } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <a href="index.php?emb=<?= $embauche['id'] ?>&amp;where=<?= $where ?>&amp;id=<?= $embauche['id'] ?>&amp;action=affich_ajoutquestion1"
                       class="btn btn-primary" style="margin-left: 60px;" type="button" href="">Ajouter une question</a>
                    <a href="index.php?emb=<?= $embauche['id'] ?>&amp;where=<?= $where ?>&amp;action=list_embauche"
                       class="btn btn-light pull-right">Retour</a>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <?php include('view/control_sidebar.php'); ?>

    <!-- REQUIRED JS SCRIPTS -->

    <?php include('view/js_links.php'); ?>

    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#tab-embauche tfoot th:not(.options)').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            // DataTable
            var table = $('#tab-embauche').DataTable({
                "language": {
                    "lengthMenu": "Afficher _MENU_ éléments par page",
                    "zeroRecords": "Aucun résultat ",
                    "info": "Affichage de la page _PAGE_ de _PAGES_",
                    "infoEmpty": "Aucun élément trouvé",
                    "infoFiltered": "(filtré du total de _MAX_ éléments)"
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