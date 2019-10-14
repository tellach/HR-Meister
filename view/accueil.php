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
<body class="hold-transition skin-blue sidebar-mini wysihtml5-supported">
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
                <li class="active"><a href="index.php"><i class="glyphicon glyphicon-home"></i> <span>Accueil</span></a></li>
                <li><a href="index.php?action=list_employes"><i
                                class="glyphicon glyphicon-folder-open"></i>
                        <span>Suivi des employés</span></a></li>

                <li><a href="index.php?action=list_candidat"><i
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

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $msggg ?>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $nombreEmploye; ?></h3>

                            <p>Nombre d'employés</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo round($moyenneSalaire, 0) . ' DA'; ?></h3>

                            <p>Moyenne salaire</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo round($employeActif, 2); ?><sup style="font-size: 20px">%</sup></h3>
                            <p>Employés en congés</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $nombreCandidat; ?></h3>

                            <p>Nombre de candidats à recontacter</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Liste des entretiens d'embauche d'aujourd'hui</h3>
                            <div class="box-tools">
                               <!-- <ul class="pagination pagination-sm no-margin pull-right">
                                    <li><a href="#">«</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>-->
                            </div>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Candidat</th>
                                    <th>Date de l'entretien</th>

                                </tr>
                                <?php
                                while ($embau = $embauches_today->fetch())
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $embau['candidat_nom'].' '.$embau['candidat_prenom']; ?></td>
                                        <td><?php echo $embau['embauche_date']; ?></td>
                                    </tr>
                                    <?php
                                }?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Liste des entretiens d'évaluation d'aujourd'hui</h3>
                            <!--<div class="box-tools">
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    <li><a href="#">«</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>-->

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Nom et prénom</th>
                                    <th>Date de l'entretien</th>

                                </tr>
                                <?php
                                while ($entret = $entretiens_today->fetch())
                                { ?>
                                    <tr>
                                        <td><?php echo $entret['nom'].' '.$entret['prenom']; ?></td>
                                        <td><?php echo $entret['date'];?></td>
                                    </tr>
                                    <?php
                                }?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <h1>Quelques statistiques</h1>
            <div class="row">
                <div class="col-md-6">
                    <!-- AREA CHART -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nombre de congés par type pour cette année </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="hint">
                                <ul style="list-style: none;padding-top: 20px;padding-bottom: 20px;padding-left: 5px;margin-left: 15px">
                                    <li style="display: inline-flex;margin-right:10px ">
                                        <div style="width: 14px;height: 14px;background-color: #4f98c3;border: 1px solid #d2d6de;margin-top: 4px;"></div>
                                        <div style="margin-left: 2px;">Annuel</div>
                                    </li>
                                    <li  style="margin-top: 9px; display: inline-flex;margin-right:10px">
                                        <div style="width: 14px;height: 14px;background-color: #FF5244;border: 1px solid #d2d6de;margin-top: 4px;"></div>
                                        <div style="margin-left: 2px;">Maladie</div>
                                    </li>
                                    <li  style="margin-top: 9px; display: inline-flex;margin-right:10px" >
                                        <div style="width: 14px;height: 14px;background-color: #D98911;border: 1px solid #d2d6de;margin-top: 4px;"></div>
                                        <div style="margin-left: 2px;">Sans solde</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="chart">
                                <canvas id="areaChart" style="height: 232px; width: 474px;" width="474"
                                        height="232"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- DONUT CHART -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ages des employés </h3>


                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart" style="height: 247px; width: 494px;" width="494"
                                    height="247"></canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                    <!-- LINE CHART -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nombre d'entretien d'embauche et d'évaluation par mois </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="hint">
                                <ul style="list-style: none;padding-top: 20px;padding-bottom: 20px;padding-left: 5px;margin-left: 15px">
                                    <li style="display: inline-flex;margin-right:10px ">
                                        <div style="width: 14px;height: 14px;background-color: #4f98c3;border: 1px solid #d2d6de;margin-top: 4px;"></div>
                                        <div style="margin-left: 2px;">Entretien d'évaluation</div>
                                    </li>
                                    <li  style="margin-top: 9px; display: inline-flex;margin-right:10px">
                                        <div style="width: 14px;height: 14px;background-color: #FF5244;border: 1px solid #d2d6de;margin-top: 4px;"></div>
                                        <div style="margin-left: 2px;">Entretien d'embauche</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="chart">
                                <canvas id="barChart" style="height: 232px; width: 474px;" width="474"
                                        height="232"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- BAR CHART -->
                    <div class="box box-success" style="display: none;">
                        <div class="box-header with-border">
                            <h3 class="box-title">line Chart</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="lineChart" style="height: 213px; width: 474px;" width="474"
                                        height="213"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col (RIGHT) -->
            </div>


        </section>
        <!-- /.content -->
    </div>
    <?php include('view/control_sidebar.php'); ?>
    <!-- /.content-wrapper -->

    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <?php include('view/js_links.php');?>

    <script>
        $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas)

            var areaChartData = {
                labels: ['JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUN', 'JUL','AOU','SEP','OCT','NOV','DEC'],
                datasets: [
                    {
                        label: 'Annuel',
                        fillColor: 'rgba(60,141,188,0.9)',
                        strokeColor: 'rgba(60,141,188,0.8)',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [
                            <?php
                            for ($i=1;$i<13;$i++)
                            {
                                echo ($conge[1][$i].',');
                            }
                            ?>
                        ]
                    },
                    {
                        label: 'Maladie',
                        fillColor: 'rgba(255,82,68,0.9)',
                        strokeColor: 'rgba(255,82,68,0.8)',
                        pointColor: '#ff5244',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [
                            <?php
                            for ($i=1;$i<13;$i++)
                            {
                                echo ($conge[2][$i].',');
                            }
                            ?>
                        ]
                    },
                    {
                        label: 'Sans solde',
                        fillColor: 'rgba(217,137,17,0.9)',
                        strokeColor: 'rgba(217,137,17,0.8)',
                        pointColor: '#d98911',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [
                            <?php
                            for ($i=1;$i<13;$i++)
                            {
                                echo ($conge[3][$i].',');
                            }
                            ?>
                        ]
                    }
                ]
            }

            var areaChartOptions = {
                //Boolean - If we should show the scale at all
                showScale: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: false,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - Whether the line is curved between points
                bezierCurve: true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension: 0.3,
                //Boolean - Whether to show a dot for each point
                pointDot: false,
                //Number - Radius of each point dot in pixels
                pointDotRadius: 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth: 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius: 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke: true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth: 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill: true,
                //String - A legend template
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true
            }

            //Create the line chart
            areaChart.Line(areaChartData, areaChartOptions)

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChart = new Chart(lineChartCanvas)
            var lineChartOptions = areaChartOptions
            lineChartOptions.datasetFill = false
            lineChart.Line(areaChartData, lineChartOptions)

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieChart = new Chart(pieChartCanvas)
            var PieData = [
                {
                    value: <?php echo $ages['16-20']; ?>,
                    color: '#f56954',
                    highlight: '#f56954',
                    label: 'Entre 16 et 20 ans'
                },
                {
                    value: <?php echo $ages['20-25']; ?>,
                    color: '#00a65a',
                    highlight: '#00a65a',
                    label: 'Entre 20 et 25 ans'
                },
                {
                    value: <?php echo $ages['25-30']; ?>,
                    color: '#f39c12',
                    highlight: '#f39c12',
                    label: 'Entre 25 et 30 ans'
                },
                {
                    value: <?php echo $ages['30-40']; ?>,
                    color: '#00c0ef',
                    highlight: '#00c0ef',
                    label: 'Entre 30 et 40 ans'
                },
                {
                    value: <?php echo $ages['40-50']; ?>,
                    color: '#3c8dbc',
                    highlight: '#3c8dbc',
                    label: 'Entre 40 et 50 ans'
                },
                {
                    value: <?php echo $ages['50-']; ?>,
                    color: '#d2d6de',
                    highlight: '#d2d6de',
                    label: 'plus que 50 ans'
                }
            ]
            var pieOptions = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke: true,
                //String - The colour of each segment stroke
                segmentStrokeColor: '#fff',
                //Number - The width of each segment stroke
                segmentStrokeWidth: 2,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps: 100,
                //String - Animation easing effect
                animationEasing: 'easeOutBounce',
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate: true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale: false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //String - A legend template
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions)

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChart = new Chart(barChartCanvas)
            var barChartData = {
                labels: ['JAN', 'FEV', 'MAR', 'AVR', 'MAI', 'JUN', 'JUL','AOU','SEP','OCT','NOV','DEC'],
                datasets: [
                    {
                        label: 'Entretien',
                        fillColor: 'rgba(60,141,188,0.9)',
                        strokeColor: 'rgba(60,141,188,0.8)',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [
                            <?php
                            for ($i=1;$i<13;$i++)
                            {
                                echo ($entretien[$i].',');
                            }
                            ?>
                        ]
                    },
                    {
                        label: 'Embauche',
                        fillColor: 'rgba(255,82,68,0.9)',
                        strokeColor: 'rgba(255,82,68,0.8)',
                        pointColor: '#ff5244',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [
                            <?php
                            for ($i=1;$i<13;$i++)
                            {
                                echo ($embauche[$i].',');
                            }
                            ?>
                        ]
                    }
                ]
            }


            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            }

            barChartOptions.datasetFill = false
            barChart.Bar(barChartData, barChartOptions)
        })
    </script>
</body>
</html>
    <?php
}
?>