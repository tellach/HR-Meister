<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="public/jsgantt.css"/>
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
                <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> <span>Accueil</span></a>
                </li>
                <li><a href="index.php?action=list_employes"><i class="glyphicon glyphicon-folder-open"></i>
                        <span>Suivi des employés</span></a></li>
                <li><a href="index.php?action=list_candidat"><i class="glyphicon glyphicon-briefcase"></i>
                        <span>Suivi des recrutements</span></a></li>
                <li class="treeview active">
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
                Affichage global des congés
            </h1>

        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div style="position:relative" class="gantt" id="GanttChartDIV">

            </div>

        </section>
        <!-- /.content -->
    </div>
    <?php include('view/control_sidebar.php'); ?>
    <!-- /.content-wrapper -->

    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <?php include('view/js_links.php'); ?>

    <script language="javascript" src="public/jsgantt.js"></script>

    <script>
        var g = new JSGantt.GanttChart(document.getElementById('GanttChartDIV'), 'week');
        /*g.AddTaskItem(new JSGantt.TaskItem(1, 'Define Chart API', '', '', 'ggroupblack', '', 0, 'Brian', 0, 1, 0, 1, '', '', 'Some Notes text', g));
        g.AddTaskItem(new JSGantt.TaskItem(11, 'Chart Object', '2016-02-20', '2016-02-20', 'gmilestone', '', 1, 'Shlomy', 100, 0, 1, 1, '', '', '', g));*/
        //JSGantt.parseXML("public/project.xml", g);
        if (g.getDivId() != null) {
            g.setCaptionType('Complete');
            g.setQuarterColWidth(36);
            g.setDateTaskDisplayFormat('day dd month yyyy');
            g.setDayMajorDateDisplayFormat('mon yyyy - Week ww');
            g.setWeekMinorDateDisplayFormat('dd mon');
            g.setShowTaskInfoLink(1);
            g.setShowEndWeekDate(0);
            g.setUseSingleCell(10000);
            g.setFormatArr('Day', 'Week', 'Month', 'Quarter');

            <?php
                $i=1;
                while ($conge=$conges->fetch())
                {
                    $comp=(time()-strtotime($conge['date_debut']))/(24*3600);
                    $comp2=(strtotime($conge['date_fin'])-strtotime($conge['date_debut']))/(24*3600);
                    //$comp3=$comp/$comp2;
                    if ($conge['type_conge']==1) {$type="Conge annuel";$color="gtaskpurple";}
                    if ($conge['type_conge']==2) {$type="Conge maladie";$color="gtaskblue";}
                    if ($conge['type_conge']==3) {$type="Conge sans solde";$color="gtaskgreen";}
                    echo 'g.AddTaskItem(new JSGantt.TaskItem('.$i.', \' '.$type.'\', \''.$conge['date_debut'].'\', \''.$conge['date_fin'].'\', \''.$color.'\', \'\', 0, \''.$conge['nom'].'\', 0, 1, 0, 1, \'\', \'\', \'Some Notes text\', g));';
                    $i++;
                }
            ?>


            //g.AddTaskItem(new JSGantt.TaskItem(1, 'Define Chart API', '', '', 'ggroupblack', '', 0, 'Brian', 0, 1, 0, 1, '', '', 'Some Notes text', g));
            //g.AddTaskItem(new JSGantt.TaskItem(11, 'Chart Object', '2016-02-20', '2016-04-20', 'gmilestone', '', 1, 'Shlomy', 100, 0, 1, 1, '', '', '', g));
           /* g.AddTaskItem(new JSGantt.TaskItem(12, 'Task Objects', '', '', 'ggroupblack', '', 0, 'Shlomy', 40, 1, 1, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(121, 'Constructor Proc', '2016-02-21', '2016-03-09', 'gtaskblue', '', 0, 'Brian T.', 60, 0, 12, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(122, 'Task Variables', '2016-03-06', '2016-03-11', 'gtaskred', '', 0, 'Brian', 60, 0, 12, 1, 121, '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(123, 'Task by Minute/Hour', '2016-03-09', '2016-03-14 12:00', 'gtaskyellow', '', 0, 'Ilan', 60, 0, 12, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(124, 'Task Functions', '2016-03-09', '2016-03-29', 'gtaskred', '', 0, 'Anyone', 60, 0, 12, 1, '123SS', 'This is a caption', null, g));
            g.AddTaskItem(new JSGantt.TaskItem(2, 'Create HTML Shell', '2016-03-24', '2016-03-24', 'gtaskyellow', '', 0, 'Brian', 20, 0, 0, 1, 122, '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(3, 'Code Javascript', '', '', 'ggroupblack', '', 0, 'Brian', 0, 1, 0, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(31, 'Define Variables', '2016-02-25', '2016-03-17', 'gtaskpurple', '', 0, 'Brian', 30, 0, 3, 1, '', 'Caption 1', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(32, 'Calculate Chart Size', '2016-03-15', '2016-03-24', 'gtaskgreen', '', 0, 'Shlomy', 40, 0, 3, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(33, 'Draw Task Items', '', '', 'ggroupblack', '', 0, 'Someone', 40, 2, 3, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(332, 'Task Label Table', '2016-03-06', '2016-03-09', 'gtaskblue', '', 0, 'Brian', 60, 0, 33, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(333, 'Task Scrolling Grid', '2016-03-11', '2016-03-20', 'gtaskblue', '', 0, 'Brian', 0, 0, 33, 1, '332', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(34, 'Draw Task Bars', '', '', 'ggroupblack', '', 0, 'Anybody', 60, 1, 3, 0, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(341, 'Loop each Task', '2016-03-26', '2016-04-11', 'gtaskred', '', 0, 'Brian', 60, 0, 34, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(342, 'Calculate Start/Stop', '2016-04-12', '2016-05-18', 'gtaskpink', '', 0, 'Brian', 60, 0, 34, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(343, 'Draw Task Div', '2016-05-13', '2016-05-17', 'gtaskred', '', 0, 'Brian', 60, 0, 34, 1, '', '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(344, 'Draw Completion Div', '2016-05-17', '2016-06-04', 'gtaskred', '', 0, 'Brian', 60, 0, 34, 1, "342,343", '', '', g));
            g.AddTaskItem(new JSGantt.TaskItem(35, 'Make Updates', '2016-07-17', '2017-09-04', 'gtaskpurple', '', 0, 'Brian', 30, 0, 3, 1, '333', '', '', g));
            */g.Draw();
        }
        else {
            alert("Error, unable to create Gantt Chart");
        }

    </script>

</body>
</html>
    <?php
}
?>