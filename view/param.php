<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php
$entreprise1=$entreprises->fetch();
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
                <li><a href="index.php?action=affichage_comptes"><i class="glyphicon glyphicon-tags"></i> <span>Gestion des comptes</span></a>
                </li>
                <li class="active"><a href="index.php?action=modification_entreprise_afiiche"><i class="glyphicon glyphicon-cog"></i> <span>Paramètres généraux</span></a>
                </li>
            </ul>
            <!-- /.sidebar-menu -->      <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <a class="btn btn-warning pull-right" type="button" <?php if($_SESSION['account_permission'] == 'G') echo ' data-toggle="modal" data-target="#modal-danger" href="#" '; else echo 'href="index.php?action=modification_entreprise_afiiche2"'?>><i class="fa fa-edit"></i> Modifier les paramètres</a>
            <h1>
                Paramètres de l'entreprise
            </h1>
            
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="row">
        <div class="col-6 col-md-8 parametres" >
          <div class="box" style="  position: relative;
                                    box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
                                    padding: 10px;
                                    background: white;">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <td>Nom de l'entreprise</td>
                  <td><?php echo $entreprise1['nom_entreprise'];?></td>
                </tr>
                <tr>
                  <td>Raison sociale</td>
                  <td><?php echo $entreprise1['raison_social'];?></td>
                </tr>
                  <tr>
                      <td>Spécialité</td>
                      <td><?php echo $entreprise1['specialite'];?></td>
                  </tr>
                  <tr>
                      <td>RC/Fiscal</td>
                      <td><?php echo $entreprise1['RC'];?></td>
                  </tr>
                  <tr>
                      <td>Adresse</td>
                      <td><?php echo $entreprise1['wilaya'] ;?></td>
                  </tr>

                  <td>Adresse mail</td>
                  <td><?php echo $entreprise1['mail'];?></td>
                </tr>
                <tr>
                  <td>Numéro de téléphone</td>
                  <td><?php echo $entreprise1['num'];?></td>
                </tr>
                <tr>
                  <td>Site web</td>
                  <td><?php echo $entreprise1['site_web'];?></td>
                </tr>
                <tr>
                  <td>Nom du gérant</td>
                  <td><?php echo $entreprise1['nom_gerant'];?></td>
                </tr>
                <tr>
                  <td>Adresse mail du gérant</td>
                  <td><?php echo $entreprise1['mail_gerant'];?></td>
                </tr>
                <tr>
                  <td>Numéro RC</td>
                  <td><?php echo $entreprise1['num_gerant'];?></td>
                </tr>
                <tr>
                  <td>Logo</td>
                  <td><img src="<?php echo $entreprise1['logo'];?>" style="height: 100px; width: 100px;"></td>
                </tr>
                <tr>
                  <td>Méssage d'accueil</td>
                  <td><?php echo $entreprise1['msg_acceuil'];?></td>
                </tr>
              </table>
                <div id="map"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
        </section>

        <!-- /.content -->
    </div>
    <?php include('view/control_sidebar.php'); ?>

    <?php include('view/js_links.php'); ?>
    <script>
        function initMap() {

            var geocoder = new google.maps.Geocoder();
            var address = "<?php echo $entreprise1['wilaya']; ?>";

            geocoder.geocode( { 'address': address}, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                }
                else
                {
                    latitude=36.729666;
                    longitude=3.088829;
                }

                var uluru = {lat: latitude,lng: longitude};
                //var uluru = {lat: -25.363, lng: 131.044};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: uluru
                });
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map,
                    title : '<?php echo $entreprise1['nom_entreprise'];?>'

                });
            });

        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnZ-9-5UqKnDo-36ZqyB-YDbH6UdQykx8&callback=initMap">
    </script>

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>

</body>
</html><?php
}
?>