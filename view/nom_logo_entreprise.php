<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php
/**
 * Created by PhpStorm.
 * User: ga_na
 * Date: 3/21/2018
 * Time: 11:20 AM
 */
$bdd=connexion_bdd();
$entreprise=new Entreprise();
$entreprises=$entreprise->get_entreprise();
$entreprise1=$entreprises->fetch();
$msggg=$entreprise1['msg_acceuil'];
?>
<div class="user-panel">
        <div class="pull-left image">
            <img src=<?php echo '"'.$entreprise1['logo'].'"' ?>  class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          </br>
          <p><?php echo $entreprise1['nom_entreprise']; ?></p>
        </div>
      </div>
    <?php
}
?>