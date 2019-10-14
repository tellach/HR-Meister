<?php
/**
 * Created by PhpStorm.
 * User: INFOSTORE
 * Date: 2/26/2018
 * Time: 11:45 PM
 */

class candidat
{
    public $nom;
    public $prenom;
    public $post;
    public $date_naissance;
    public $salaire;
    public $cv;
    public $tel;
    public $email;
    public $comment;
    public $etat;



 public function candidatexist($a){
        $req=$this->getcandidat();
        while ($candidat = $req->fetch()) {
            if ($candidat['id']==$a)
                return 1;

        }
        return 0;



        }

    public function modification_candidat($id){
        $bdd = $this->connexion_bdd();
        $req = $bdd->prepare('UPDATE candidat SET nom=:nom,prenom=:prenom,post=:post,date_naissance=:date_naissance,salaire=:salaire,cv=:cv,tel=:tel,email=:email,comment=:comment,etat=:etat WHERE id=:id');
        $req->execute(array(
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'post' => $this->post,
            'date_naissance' => $this->date_naissance,
            'salaire' => $this->salaire,
            'cv' => $this->cv,
            'tel' => $this->tel,
            'email' => $this->email,
            'comment' => $this->comment,
            'etat'=>$this->etat,
            'id' => $id
        ));
    }



    public function modification_candidat2($id)


    {  $da=strtotime($this->date_naissance);
        $de=strtotime('1998-01-01');
        if($da<$de) {

            if ((isset($_FILES['cv'])) and ($_FILES['cv']['error'] == 0)) {
                $info_fichier = pathinfo($_FILES['cv']['name']);
                $extension_upload = $info_fichier['extension'];
                $extension_autorisées = array('jpg', 'jpeg', 'png', 'txt', 'docx');
                if (in_array($extension_upload, $extension_autorisées)) {
                    move_uploaded_file($_FILES['cv']['tmp_name'], 'uploads/' . basename($_FILES['cv']['name']));

                    $this->cv = 'uploads/' . basename($_FILES['cv']['name']);


                    $bdd = $this->connexion_bdd();
                    $req = $bdd->prepare('UPDATE candidat SET nom=:nom,prenom=:prenom,post=:post,date_naissance=:date_naissance,salaire=:salaire,cv=:cv,tel=:tel,email=:email,comment=:comment,etat:=etat WHERE id=:id');
                    $req->execute(array(
                        'nom' => $this->nom,
                        'prenom' => $this->prenom,
                        'post' => $this->post,
                        'date_naissance' => $this->date_naissance,
                        'salaire' => $this->salaire,

                        'cv' => $this->cv,
                        'tel' => $this->tel,
                        'email' => $this->email,
                        'comment' => $this->comment,
                        'etat'=>$this->etat,
                        'id' => $id
                    ));

                } }else {

                    $bdd = $this->connexion_bdd();
                    $req = $bdd->prepare('UPDATE candidat SET nom=:nom,prenom=:prenom,post=:post,date_naissance=:date_naissance,salaire=:salaire,tel=:tel,email=:email,comment=:comment,etat=:etat WHERE id=:id');
                    $req->execute(array(
                        'nom' => $this->nom,
                        'prenom' => $this->prenom,
                        'post' => $this->post,
                        'date_naissance' => $this->date_naissance,
                        'salaire' => $this->salaire,
                        'tel' => $this->tel,
                        'email' => $this->email,
                        'comment' => $this->comment,
                        'etat'=>$this->etat,
                        'id' => $id
                    ));
                }
                return 0;
            } else {
                return 1;
            }
        }

    public function set_candidat()
    {

        if ((isset($_FILES['cv'])) and ($_FILES['cv']['error'] == 0)) {


            if ((isset($_POST['nom'])) and (isset($_POST['prenom'])) and (isset($_POST['email'])) and (isset($_POST['tel']))  and (isset($_POST['post'])) and (isset($_POST['date_naissance'])) and (isset($_POST['salaire']))and  (isset($_POST['comment']))and  (isset($_POST['etat']))) {

                $info_fichier = pathinfo($_FILES['cv']['name']);
                $extension_upload = $info_fichier['extension'];
                $extension_autorisées = array('jpg', 'jpeg', 'png','txt','docx');
                if (in_array($extension_upload, $extension_autorisées)) {
                    move_uploaded_file($_FILES['cv']['tmp_name'], 'uploads/' . basename($_FILES['cv']['name']));

                    $this->nom= ($_POST['nom']);
                    $this->prenom= ($_POST['prenom']);
                    $this-> post= ($_POST['post']);
                    $this->date_naissance= ($_POST['date_naissance']);
                    $this->salaire= ($_POST['salaire']);
                    $this->tel= ($_POST['tel']);
                    $this->email= ($_POST['email']);
                    $this->comment= ($_POST['comment']);
                    $this->etat=$_POST['etat'];
                    $this->cv = 'uploads/' . basename($_FILES['cv']['name']);

                    return "avec_fichier";


                }
            }
        }
        else {

            if (( isset($_POST['nom'])) and (isset($_POST['prenom'])) and (isset($_POST['email'])) and (isset($_POST['tel'])) and (isset($_POST['post'])) and (isset($_POST['date_naissance'])) and (isset($_POST['salaire']))and  (isset($_POST['comment']))and  (isset($_POST['etat']))) {

                $this->nom= ($_POST['nom']);
                $this->prenom= ($_POST['prenom']);
                $this-> post= ($_POST['post']);
                $this->date_naissance= ($_POST['date_naissance']);
                $this->salaire= ($_POST['salaire']);
                $this->tel= ($_POST['tel']);
                $this->email= ($_POST['email']);
                $this->comment= ($_POST['comment']);
                $this->etat=$_POST['etat'];
                return "sans_fichier";


            }
        }
    }



    public function setcandidat($nom,$prenom,$post,$date_naissance,$salaire,$tel,$email,$comment,$etat)
    { $this->nom=$nom;
        $this->prenom=$prenom;
        $this->post=$post;
        $this->date_naissance=$date_naissance;
        $this->salaire=$salaire;
        $this->tel=$tel;
        $this->email=$email;
        $this->comment=$comment;
        $this->etat=$etat;
    }


    public function insert_db_candidat()
    {
        $da=strtotime($this->date_naissance);
        $de=strtotime('1998-01-01');
        if($da<$de){
        $bdd = $this->connexion_bdd();
        //$req=$bdd->prepare('INSERT INTO candidat(matricule,nom,prenom,post,assurence,date_naissance,date_embauche,situation_fam,respo,salaire,projet,num_social,contrat,cv,date_demission,adresse,tel,email,conge,reste_conge,coord_bancaire,comment)  VALUES (:matricule,:nom,:prenom,:post,:assurence,:date_naissance,:date_embauche,:situation_fam,:respo,:salaire,:projet,:num_social,:contrat,:cv,:date_demission,:adresse,:tel,:email,:conge,:reste_conge,:coord_bancaire,:comment)');
        $req = $bdd->prepare('INSERT INTO candidat (nom,prenom,post,date_naissance,salaire,cv,tel,email,comment,etat) VALUES (:nom,:prenom,:post,:date_naissance,:salaire,:cv,:tel,:email,:comment,:etat)');
        $req->execute(array(
            'nom' => ($this->nom),
            'prenom' => ($this->prenom),
            'post' => ($this->post),
            'date_naissance' => ($this->date_naissance),
            'salaire' => ($this->salaire),
            'cv' => ($this->cv),
            'tel' => ($this->tel),
            'email' => ($this->email),
            'comment' => ($this->comment),
            'etat'=>($this->etat)
        ));
        return 0;
    }else{return 1;

}
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









    public function getcandidat()
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM candidat');
        $req->execute();

        return $req;

    }
    public function getcandidat_id($id)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM candidat WHERE (id=?)');
        $req->execute(array($id));

        return $req;

    }



    public function affiche()
    {


        echo 'nom '.$this->nom.'<br>';
        echo 'prenom '.$this->prenom.'<br>';
        echo 'post '.$this->post.'<br>';
        echo 'date_naissance '.$this->date_naissance.'<br>';
        echo 'salaire '.$this->salaire.'<br>';
        echo 'cv '.$this->cv.'<br>';
        echo 'tel '.$this->tel.'<br>';
        echo 'email '.$this->email.'<br>';
        echo 'comment '.$this->comment.'<br>';

    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /*
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    public static function totalCandidat()
    {
        $bdd=connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM candidat WHERE etat=?' );
        $req->execute(array("recontacte"));
        return $req->rowCount();
    }



}