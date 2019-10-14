<?php
/**
 * Created by PhpStorm.
 * User: INFOSTORE
 * datee: 3/21/2018
 * Time: 9:45 PM
 */

class Embauche
{//public $id;
    private $datee;
    private $matricule;
    private $fk;
    private $question;
    private $reponse;
    private $note;
    private $poste;
    private $salaire;/**
 * embauche constructor.
 * @param $datee
 * @param $matricule
 * @param $note
 * @param $poste
 * @param $salaire
 */
    public static function getquestions($a)
    {
        $bdd=Utilitaire::connexion_bdd();

        $req=$bdd->prepare('SELECT  * FROM questions WHERE fk=?');
        $req->execute(array($a));

        return $req;
    }

    public static function getembauchecandidat($b)
    {
        $bdd=Utilitaire::connexion_bdd();

        $sql =  'SELECT  embauche.id AS id , candidat.nom AS nom , candidat.prenom AS prenom  , embauche.note AS note , embauche.datee AS datee ,embauche.salaire AS salaire  ,embauche.poste AS poste  ,embauche.matricule AS matricule 
                                        FROM `embauche`
                                        INNER JOIN `candidat`
                                        ON `embauche`.`matricule`=`candidat`.`id` 
                                         WHERE `embauche`.`matricule`=?
                                      ';
        $req=$bdd->prepare($sql);
        $req->execute(array($b));
        return $req;
    }

    public static function getembauchetoday()
    {
        $bdd=Utilitaire::connexion_bdd();

        $sql =  'SELECT  embauche.id AS id , candidat.nom AS nom , candidat.prenom AS prenom  , embauche.note AS note , embauche.datee AS datee ,embauche.salaire AS salaire  ,embauche.poste AS poste  ,embauche.matricule AS matricule 
                                        FROM `embauche`
                                        INNER JOIN `candidat`
                                        ON `embauche`.`matricule`=`candidat`.`id` 
                                         WHERE `embauche`.`datee`=?
                                      ';
        $req=$bdd->prepare($sql);
        $req->execute(array(date('Y-m-d')));
        return $req;
    }

    public static function getembauchepass()
    {
        $bdd=Utilitaire::connexion_bdd();

        $sql =  'SELECT  embauche.id AS id , candidat.nom AS nom , candidat.prenom AS prenom  , embauche.note AS note , embauche.datee AS datee ,embauche.salaire AS salaire  ,embauche.poste AS poste  ,embauche.matricule AS matricule 
                                        FROM `embauche`
                                        INNER JOIN `candidat`
                                        ON `embauche`.`matricule`=`candidat`.`id` 
                                         WHERE `embauche`.`datee`<?
                                      ';
        $req=$bdd->prepare($sql);
        $req->execute(array(date('Y-m-d')));
        return $req;
    }

    public static function getembauchefutur()
    {
        $bdd=Utilitaire::connexion_bdd();

        $sql =  'SELECT  embauche.id AS id , candidat.nom AS nom , candidat.prenom AS prenom  , embauche.note AS note , embauche.datee AS datee ,embauche.salaire AS salaire  ,embauche.poste AS poste  ,embauche.matricule AS matricule 
                                        FROM `embauche`
                                        INNER JOIN `candidat`
                                        ON `embauche`.`matricule`=`candidat`.`id` 
                                         WHERE `embauche`.`datee`>?
                                      ';
        $req=$bdd->prepare($sql);
        $req->execute(array(date('Y-m-d')));
        return $req;
    }

    public function supp_embauche($id)
    {
        $bdd=Utilitaire::connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM embauche WHERE id=? ');
        $req->execute(array($id));
        $num_of_rows=$req->rowCount();
        if ($num_of_rows==1)
        {
            $donnee=$req->fetch();
            $this->matricule = $donnee['matricule'];
            $this->note = $donnee['note'];
            $this->salaire = $donnee['salaire'];
            $this->poste =$donnee['poste'];
            $this->datee =$donnee['datee'];
            $datee1=strtotime($this->datee);
           // echo$datee1;
            $datee_actuelle=strtotime(date('Y-m-d'));
            //echo $datee_actuelle;
            if (($datee1>$datee_actuelle))
            {

                //$req->closeCursor();
                $req=$bdd->prepare('DELETE FROM embauche WHERE id=? ');
                $req->execute(array($id));

            }
            else
            {
                //Suppression pas valide
            }
        }
    }

    public function report_embauche($id,$daten)
    {
        $bdd=Utilitaire::connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM embauche WHERE id=? ');
        $req->execute(array($id));
        $num_of_rows=$req->rowCount();
        if ($num_of_rows==1)
        {
            $donnee=$req->fetch();
            $this->matricule = $donnee['matricule'];
            $this->note = $donnee['note'];
            $this->salaire = $donnee['salaire'];
            $this->poste =$donnee['poste'];
            $this->datee =$donnee['datee'];
           // $datee1=strtotime($this->datee);
            // echo$datee1;
            //echo$daten;
           // $datee_actuelle=strtotime(date('Y-m-d'));
            //echo $datee_actuelle;


                //$req->closeCursor();
            $datee1=strtotime($daten);
            $datee_actuelle=strtotime(date('Y-m-d'));
            if ($datee_actuelle <= $datee1)
            {      $bdd=$this->connexion_bdd();

                $sql = "UPDATE embauche SET datee=?,matricule=?, poste=?, salaire=?, note=? WHERE id=?";
                $bdd->prepare($sql)->execute(array($daten,$this->matricule,$this->poste,$this->salaire,$this->note,$id));
                //$req->closeCursor();
                return 1;


            }
            else {
                    return 0;
            }
        }
    }


    public function supp_question($id)
    {
        $bdd=Utilitaire::connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM questions WHERE id=? ');
        $req->execute(array($id));
        $num_of_rows=$req->rowCount();
        if ($num_of_rows==1)
        {
            $req=$bdd->prepare('DELETE FROM questions WHERE id=? ');
            $req->execute(array($id));


        }else
        {
            //cas impossible
        }
    }


    public function setembauche($datee, $matricule, $note, $poste, $salaire)
    {
        $this->datee = $datee;
        $this->matricule = $matricule;
        $this->note = $note;
        $this->poste = $poste;
        $this->salaire = $salaire;
    }

    public function setembauche2($datee, $note, $poste, $salaire)
    {
        $this->datee = $datee;
        $this->note = $note;
        $this->poste = $poste;
        $this->salaire = $salaire;
    }/**
 * @return mixed
 */

    public function modification_embauche2($id)
    {
        $bdd=$this->connexion_bdd();

        $datee1=strtotime($this->datee);
        $datee_actuelle=strtotime(date('Y-m-d'));
        if ($datee_actuelle <= $datee1) {
            $sql = "UPDATE embauche SET datee=?,matricule=?, poste=?, salaire=?, note=? WHERE id=?";
            $bdd->prepare($sql)->execute(array($this->datee, $this->matricule, $this->poste, $this->salaire, $this->note, $id));
            return 1;
        }else{
            return 0;
        }

    }

    public function modification_question2($id,$quest,$rep)
    {
        $bdd=$this->connexion_bdd();
        $sql = "UPDATE questions SET question=?,reponse=? WHERE id=?";
        $bdd->prepare($sql)->execute(array($quest,$rep,$id));

    }

    public function insert_db_question(){

        //echo $this->reponse;

        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('INSERT INTO questions(question,reponse,fk) VALUES (:question,:reponse,:fk)');
        $req->execute(array(
            'question'=>($this->question),
            'fk'=>($this->fk),
            'reponse'=>($this->reponse)
        ));



    }


    public function set_question(){
        if ((isset($_POST['id'])) and (isset($_POST['question'])) and (isset($_POST['reponse'])) )
        {
            $this->fk = ($_POST['id']);

            $this->question = ($_POST['question']);
            $this->reponse = ($_POST['reponse']);




            return 1;


        }else{
            return 0;
        }
    }



    public function set_embauche(){
        if ((isset($_POST['datee'])) and (isset($_POST['matricule'])) and (isset($_POST['note'])) and (isset($_POST['salaire']))  and (isset($_POST['poste'])))
        {
            $this->datee = ($_POST['datee']);
            $this->matricule = ($_POST['matricule']);
            $this->note = ($_POST['note']);
            $this->poste = ($_POST['poste']);
            $this->salaire = ($_POST['salaire']);


            return 1;


        }else{
            return 0;
        }
    }

    public function validation_embauche()
    {       $datee1=strtotime($this->datee);
        $datee_actuelle=strtotime(date('Y-m-d'));
        if ($datee_actuelle <= $datee1)
        {
            //$req->closeCursor();
            return 1;


        }
        else {
        //echo'dateeeeee expireee';
            return 0;
        }

    }

    public function insert_db_embauche()
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('INSERT INTO embauche(datee,matricule,poste,salaire,note) VALUES (:datee,:matricule,:poste,:salaire,:note)');
        $req->execute(array(
            'datee'=>($this->datee),
            'matricule'=>($this->matricule),
            'poste'=>($this->poste),
            'salaire'=>($this->salaire),
            'note'=>($this->note)
        ));
    }

    public function connexion_bdd()
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

    public function getembauche()
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM embauche');
        $req->execute();

        return $req;

    }

    public function getquestion_id($id)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM questions WHERE (id=?)');
        $req->execute(array($id));
        return $req;


    }

    public function getembauche_id($id)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM embauche WHERE (id=?)');
        $req->execute(array($id));

        return $req;

    }

    public function getembauche_id2($id)
    {
        $bdd=$this->connexion_bdd();
        $sql =  'SELECT  embauche.id AS id,candidat.nom AS nom , candidat.prenom AS prenom  , embauche.note AS note , embauche.datee AS datee ,embauche.salaire AS salaire  ,embauche.poste AS poste  ,embauche.matricule AS matricule 
                                        FROM `embauche`,`candidat`
                                       /* INNER JOIN `candidat`*/
                                      WHERE `embauche`.`matricule`=`candidat`.`id` 
                                      ';
        //$bdd->query($sql);
        $req=$bdd->prepare($sql);
        $req->execute(array($id));
        $emb=$req->fetch();
        while($emb['id']!=$id) {
            $emb=$req->fetch();

        }


        return $emb;

    }

    public function affiche()
    {


        echo 'datee '.$this->datee.'<br>';
        echo 'matricule '.$this->matricule.'<br>';
        echo 'post '.$this->poste.'<br>';
        echo 'salaire '.$this->salaire.'<br>';
        echo 'note'.$this->note.'<br>';


    }

    public function getdatee()
    {
        return $this->datee;
    }/**
 * @param mixed $datee
 */
    public function setdatee($datee)
    {
        $this->datee = $datee;
    }/**
 * @return mixed
 */
    public function getMatricule()
    {
        return $this->matricule;
    }/**
 * @param mixed $matricule
 */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }/**
 * @return mixed
 */
    public function getNote()
    {
        return $this->note;
    }/**
 * @param mixed $note
 */
    public function setNote($note)
    {
        $this->note = $note;
    }/**
 * @return mixed
 */
    public function getPoste()
    {
        return $this->poste;
    }/**
 * @param mixed $poste
 */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    }/**
 * @return mixed
 */
    public function getSalaire()
    {
        return $this->salaire;
    }/**
 * @param mixed $salaire
 */
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;
    }

    public static function getEmbaucheParMois($mois)
    {
        $year=date("Y");
        $dateLim1=($year."-".$mois."-01");
        $dateLim2=($year."-".$mois."-31");
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  *
                                        FROM embauche
                                        WHERE datee > ? AND datee < ?            ');
        $reponse->execute(array($dateLim1,$dateLim2));
        return $reponse->rowCount();
    }

    public static function getEmbaucheParMoisTotal()
    {

        for ($i=1;$i<13;$i++)
        {
            $embauche[$i]=self::getEmbaucheParMois($i);
        }
        return $embauche;
    }

    public static function getEmbaucheAujourdhui()
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->query('SELECT embauche.id AS embauche_id , embauche.datee AS embauche_date , candidat.nom AS candidat_nom ,candidat.prenom AS candidat_prenom 
                                        FROM `embauche`
                                        INNER JOIN `candidat`
                                        ON `embauche`.`matricule` = `candidat`.`id`
                                        WHERE `embauche`.`datee`= CURDATE()            ');
        //$reponse->execute(array(date('Y-m-d H:i:s')));
        return $reponse;
    }




}