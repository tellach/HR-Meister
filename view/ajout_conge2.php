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
    <meta charset="utf-8" />
    <title>Ajouter un congé</title>
    <link href="#" rel="stylesheet" />
</head>

<body>
    <form action="index.php?action=ajout_conge" method="post" enctype="multipart/form-data">
        <label for="author">matricule</label><br />
        <input type="text" id="author" name="matricule" required />

        <label for="author">Type de conge</label><br />
        <Select  name="type_conge" id="Raison social">
            <optgroup label="Conge">
                <option value="1"> Annuel</option>
                <option value="2"> Maladie </option>
                <option value="3"> Sans solde </option>
            </optgroup>
        </select>

        <label for="author">date_debut</label><br />
        <input type="date" id="author" name="date_debut" required/>

        <label for="author">date_fin</label><br />
        <input type="date" id="author" name="date_fin" required/>

        <p> <input type="file" name ="f" value="Choisisez un fichier" onchange="previewfile()" required> Aucun fichier choisi </p>
        <p> <input type="reset" value="effacer">
        <input type="submit" value="envoyer"> </p>
    </form>
    <div style="color: #ff4e33;"> <?php if (isset($retour)) echo $retour ?> </div>
</body>
</html>
    <?php
}
?>