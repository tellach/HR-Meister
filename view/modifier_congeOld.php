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
 * Date: 3/2/2018
 * Time: 10:48 AM
 */
?>
<form action="../index.php?action=modifier_conge&amp;id=<?= $_GET['id'] ?>&critere=date_debut" method="post" enctype="multipart/form-data">
        <label for="author">Date debut</label><br />
        <input type="date" id="author" name="date" required />
        <input type="submit" value="Modifier"> </p>
</form>

<form action="../index.php?action=modifier_conge&amp;id=<?= $_GET['id'] ?>&critere=date_fin" method="post" enctype="multipart/form-data">
        <label for="author">Date Fin</label><br />
        <input type="date" id="author" name="date" required />
        <input type="submit" value="Modifier"> </p>
</form>
    <?php
}
?>