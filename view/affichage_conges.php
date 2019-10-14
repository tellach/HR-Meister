<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('view/css_links.php'); ?>
    <title>Affichage des congés</title>
</head>
<body>
<?php
    $date = date('Y-m-d H:i:s');
    $actual=strtotime($date);
    while ($conge=$conges->fetch())
    {

        echo 'ID :'.$conge['id_conge'].'</br>';
        echo 'Nom : '.$conge['nom'].'-     Prenom :'.$conge['prenom'].'-     Type du congé :'.$conge['type_conge'].'-     Date début :'.$conge['date_debut'].'-      Date fin :'.$conge['date_fin']. '</br>';
        if(strtotime($date)<strtotime($conge['date_fin'])) {    ?><a href="./view/modifier_conge.php?id=<?= $conge['id_conge'] ?>">Modifier</a><?php } else {}
        if(strtotime($conge['date_debut'])>strtotime($date)) {   ?><a href="index.php?action=supprimer_conge&amp;id=<?= $conge['id_conge'] ?>">Supprimer</a><?php } else {}
        if((strtotime($conge['date_fin'])>strtotime($date))&&(strtotime($conge['date_debut'])<strtotime($date))) {   ?><a href="index.php?action=arreter_conge&amp;id=<?= $conge['id_conge'] ?>">Arreter le congé</a><?php } else {}
    }
?>
</br></br><a href="./view/ajout_conge.php">Ajouter un nouveau conge</a>

</body>
</html>
    <?php
}
?>