<?php
session_start();

if (isset($_SESSION['connect']))//On vérifie que le variable existe.
{
        $connect=$_SESSION['connect'];//On récupère la valeur de la variable de session.
}
else
{
    $connect=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}       
if ($connect == 0) // Si le visiteur s'est identifié.
{
	session_destroy();
	header("Location:../view/connexion.php");
}	
// On affiche la page cachée.
?>
