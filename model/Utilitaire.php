<?php
/**
 * Created by PhpStorm.
 * User: ga_na
 * Date: 2/19/2018
 * Time: 6:18 PM
 */

class Utilitaire
{
    public static function connexion_bdd()
    {
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=grh;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        return $bdd;
    }

}