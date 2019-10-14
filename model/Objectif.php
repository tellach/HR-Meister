<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 17/03/2018
 * Time: 16:57
 */

class Objectif
{
    private $id;
    private $matricule;
    private $objectif;
    private $date_debut;
    private $type_objectif;
    private $evaluation;

    private function set_objectif1($matricule,$objectif,$date_debut,$type_objectif)
    {
        $this->matricule=$matricule;
        $this->objectif=$objectif;
        $this->date_debut=$date_debut;
        $this->type_objectif=$type_objectif;
        $this->evaluation='C';
    }
    private function set_objectif22($objectif,$date_debut,$type_objectif,$evaluation)
    {
        $this->objectif=$objectif;
        $this->date_debut=$date_debut;
        $this->type_objectif=$type_objectif;
        $this->evaluation=$evaluation;
    }
    public function Set_objectif($matricule)
    {
        if (isset($_POST['objectif'],$_POST['type_objectif'],$_POST['date_debut']))
        {
            $date_debut=date("Y-m-d");
            $this->set_objectif1(strip_tags($matricule),strip_tags($_POST['objectif']),$_POST['date_debut'],strip_tags($_POST['type_objectif']));
        }
    }
    public function Set_objectif2()
    {
        if (isset($_POST['objectif'],$_POST['date'],$_POST['type_objectif'],$_POST['evaluation']))
        {
            $date_debut=strtotime(date("Y-m-d"));
            $this->set_objectif22(strip_tags($_POST['objectif']),strip_tags($_POST['date']),strip_tags($_POST['type_objectif']),strip_tags($_POST['evaluation']));
        }
    }
    public function insert_into_db()
    {
        $bdd=$this->connexion_bdd();
        $date_debut=strtotime(date("Y-m-d"));
        $date_inserer=strtotime($this->date_debut);
        if($date_inserer>=$date_debut)
        {
        $req=$bdd->prepare('INSERT INTO objectif (matricule,objectif,date_debut,type,Evaluation) VALUES (:matricule,:objectif,:date_debut,:type,:Evaluation) ');
        $req->execute(array(
            'matricule'=>$this->matricule,
            'objectif'=>$this->objectif,
            'date_debut'=>$this->date_debut,
            'type'=>$this->type_objectif,
            'Evaluation'=>$this->evaluation,

        ));
        return 'succes';
        }
        else
        {
           return 'error';
        }
    }
    public function supprimer($id)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('DELETE FROM objectif WHERE (id=?)' );
        $req->execute(array($id));
    }
    public function get_objectifs($matricule)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM objectif WHERE (matricule=?) ORDER BY date_debut  DESC');
        $req->execute(array($matricule));
        return $req;

    }
    public function get_objectif($id)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM objectif WHERE id=?');
        $req->execute(array($id));
        return $req;
    }
    public function modifier_objectif($id)
    {

            $bdd=$this->connexion_bdd();
            $date_debut=strtotime(date("Y-m-d"));
            $date_inserer=strtotime($this->date_debut);
            if($date_inserer>=$date_debut)
            {
            $req=$bdd->prepare('UPDATE objectif SET objectif=:objectif,date_debut=:date_debut,type=:type,Evaluation=:Evaluation WHERE id=:id');
            $req->execute(array(

                'objectif'=>$this->objectif,
                'date_debut'=>$this->date_debut,
                'type'=>$this->type_objectif,
                'Evaluation'=>$this->evaluation,
                'id'=>($id),
            ));
                return 'succes';
            }
            else
            {
                return 'error';
            }

    }
    private function connexion_bdd()
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