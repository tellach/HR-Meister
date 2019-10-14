<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 18/02/2018
 * Time: 15:23
 */

class Employe
{
    private $matricule;
    private $nom;
    private $prenom;
    private $statut;
    private $post;
    private $assurence;
    private $date_naissance;
    private $lieu_naissance;
    private $date_embauche;
    private $situation_fam;
    private $respo;
    private $salaire;
    private $projet;
    private $num_social;
    private $contrat='';
    private $cv;
    private $date_demission;
    private $adresse;
    private $tel;
    private $email;
    private $conge;
    private $reste_conge;
    private $coord_bancaire;
    private $comment;


    public function getNom()
    {
        return $this->nom;
    }


    public function getPrenom()
    {
        return $this->prenom;
    }


    public function getPost()
    {
        return $this->post;
    }

    public function validationAjout()
    {
        $errors['exists']=0;
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM employe WHERE matricule=?');
        $req->execute(array($this->matricule));
        if ($req->rowCount()!=0)
        {
            $errors['exists']=1;
            $errors['matricule']=1;
        }
        else
        {
            $errors['matricule']=0;
        }
        $req->closeCursor();

        if (strtotime($this->date_naissance)>(strtotime(date('Y-m-d H:i:s'))-16*365*24*3600))
        {
            $errors['exists']=1;
            $errors['date_naissance']=1;
        }
        else
        {
            $errors['date_naissance']=0;
        }

        if (strtotime($this->date_embauche)>(strtotime(date('Y-m-d H:i:s'))+ 365*24*3600))
        {
            $errors['exists']=1;
            $errors['date_embauche']=1;
        }
        else
        {
            $errors['date_embauche']=0;
        }

        return $errors;
    }

    public function validationModif($id)
    {
        $errors['exists']=0;
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM employe WHERE matricule=?');
        $req->execute(array($this->matricule));
        $num=$req->rowCount();
        if ($num>0)
        {
            if($num==1)
            {
                $employe=$req->fetch();
                $req=$bdd->prepare('SELECT * FROM employe WHERE id=?');
                $req->execute(array($id));
                $employeOrigin=$req->fetch();
                if ($employe['id']==$employeOrigin['id'])
                {
                    $errors['matricule']=0;
                }
                else
                {
                    $errors['exists']=1;
                    $errors['matricule']=1;
                }
            }
            else
            {
                $errors['exists']=1;
                $errors['matricule']=1;
            }

        }
        else
        {
            $errors['matricule']=0;
        }
        $req->closeCursor();

        if (strtotime($this->date_naissance)>(strtotime(date('Y-m-d H:i:s'))-16*365*24*3600))
        {
            $errors['exists']=1;
            $errors['date_naissance']=1;
        }
        else
        {
            $errors['date_naissance']=0;
        }

        if (strtotime($this->date_embauche)>(strtotime(date('Y-m-d H:i:s'))+ 365*24*3600))
        {
            $errors['exists']=1;
            $errors['date_embauche']=1;
        }
        else
        {
            $errors['date_embauche']=0;
        }

        return $errors;
    }





    public function setemploye($matricule, $nom, $prenom, $statut, $post, $assurence, $date_naissance, $lieu_naissance, $date_embauche, $situation_fam, $respo
        , $salaire, $projet, $num_social, $contrat, $cv, $date_demission, $adresse, $tel, $email, $conge, $reste_conge, $coord_bancaire, $comment)
    {
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->statut = $statut;
        $this->post = $post;
        $this->assurence = $assurence;
        $this->date_naissance = $date_naissance;
        $this->lieu_naissance=$lieu_naissance;
        $this->date_embauche = $date_embauche;
        $this->situation_fam = $situation_fam;
        $this->respo = $respo;
        $this->salaire = $salaire;
        $this->projet = $projet;
        $this->num_social = $num_social;
        $this->contrat = $contrat;
        $this->cv = $cv;
        $this->date_demission = $date_demission;
        $this->adresse = $adresse;
        $this->tel = $tel;
        $this->email = $email;
        $this->conge = $conge;
        $this->reste_conge = $reste_conge;
        $this->coord_bancaire = $coord_bancaire;
        $this->comment = $comment;
    }
    private function setemploye3($matricule, $nom, $prenom, $statut, $post, $assurence, $date_naissance,$lieu_naissance, $date_embauche, $situation_fam, $respo
        , $salaire, $projet, $num_social, $date_demission, $adresse, $tel, $email, $conge, $reste_conge, $coord_bancaire, $comment)
    {
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->statut = $statut;
        $this->post = $post;
        $this->assurence = $assurence;
        $this->date_naissance = $date_naissance;
        $this->lieu_naissance=$lieu_naissance;
        $this->date_embauche = $date_embauche;
        $this->situation_fam = $situation_fam;
        $this->respo = $respo;
        $this->salaire = $salaire;
        $this->projet = $projet;
        $this->num_social = $num_social;
        $this->date_demission = $date_demission;
        $this->adresse = $adresse;
        $this->tel = $tel;
        $this->email = $email;
        $this->conge = $conge;
        $this->reste_conge = $reste_conge;
        $this->coord_bancaire = $coord_bancaire;
        $this->comment = $comment;
    }


    public function setemploye2()
    {

        if (((isset($_FILES['contrat'])) && ($_FILES['contrat']['error'] == 0)) and ((isset($_FILES['cv'])) && ($_FILES['cv']['error'] == 0)))
        {


            if (isset($_POST['valider']) and isset($_POST['matricule']) and ($_POST['nom']) and isset($_POST['prenom']) and ($_POST['statut']) and isset($_POST['post']) and ($_POST['assurence']) and
                isset($_POST['date_naissance']) and isset($_POST['lieu']) and isset($_POST['date_embauche']) and isset($_POST['situation_fam']) and isset($_POST['respo']) and isset($_POST['salaire']) and isset($_POST['projet']) and
                isset($_POST['num_social']) and isset($_POST['date_demission']) and isset($_POST['adresse']) and isset($_POST['tel']) and isset($_POST['email']) and
                isset($_POST['conge']) and isset($_POST['reste_conge']) and isset($_POST['coord_bancaire']) and isset($_POST['comment'])) {
                $info_fichier = pathinfo($_FILES['contrat']['name']);
                $extension_upload = $info_fichier['extension'];
                $extension_autorisées = array('pdf', 'txt', 'docx');
                if (in_array($extension_upload, $extension_autorisées)) {
                    move_uploaded_file($_FILES['contrat']['tmp_name'], 'uploads/' . basename($_FILES['contrat']['name']));
                }
                $this->contrat = 'uploads/' . basename($_FILES['contrat']['name']);
                $info_fichier = pathinfo($_FILES['cv']['name']);
                $extension_upload = $info_fichier['extension'];
                $extension_autorisées = array('pdf', 'txt', 'docx');
                if (in_array($extension_upload, $extension_autorisées)) {
                    move_uploaded_file($_FILES['cv']['tmp_name'], 'uploads/cv_' . $_POST['matricule'].'_'.$_POST['nom']);
                }
                $this->setemploye3($_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['statut'], $_POST['post'], $_POST['assurence'],
                    $_POST['date_naissance'],$_POST['lieu'], $_POST['date_embauche'], $_POST['situation_fam'], $_POST['respo'], $_POST['salaire'], $_POST['projet'],
                    $_POST['num_social'], $_POST['date_demission'], $_POST['adresse'], $_POST['tel'], $_POST['email'],
                    $_POST['conge'], $_POST['reste_conge'], $_POST['coord_bancaire'], $_POST['comment']);
                $this->cv = 'uploads/'.$_POST['matricule'].'_'.$_POST['nom'];


                return 1;
            }

        }
        elseif ((isset($_FILES['contrat'])) && ($_FILES['contrat']['error'] == 0))
        {


            if (isset($_POST['valider']) and isset($_POST['matricule']) and ($_POST['nom']) and isset($_POST['prenom']) and ($_POST['statut']) and isset($_POST['post']) and ($_POST['assurence']) and
                isset($_POST['date_naissance']) and isset($_POST['lieu']) and isset($_POST['date_embauche']) and isset($_POST['situation_fam']) and isset($_POST['respo']) and isset($_POST['salaire']) and isset($_POST['projet']) and
                isset($_POST['num_social']) and isset($_POST['date_demission']) and isset($_POST['adresse']) and isset($_POST['tel']) and isset($_POST['email']) and
                isset($_POST['conge']) and isset($_POST['reste_conge']) and isset($_POST['coord_bancaire']) and isset($_POST['comment']))
            {
                $info_fichier = pathinfo($_FILES['contrat']['name']);
                $extension_upload = $info_fichier['extension'];
                $extension_autorisées = array('pdf', 'txt', 'docx');
                if (in_array($extension_upload, $extension_autorisées))
                {
                    move_uploaded_file($_FILES['contrat']['tmp_name'], 'uploads/' . basename($_FILES['contrat']['name']));
                    $this->setemploye3($_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['statut'], $_POST['post'], $_POST['assurence'],
                        $_POST['date_naissance'],$_POST['lieu'], $_POST['date_embauche'], $_POST['situation_fam'], $_POST['respo'], $_POST['salaire'], $_POST['projet'],
                        $_POST['num_social'], $_POST['date_demission'], $_POST['adresse'], $_POST['tel'], $_POST['email'],
                        $_POST['conge'], $_POST['reste_conge'], $_POST['coord_bancaire'], $_POST['comment']);

                    $this->contrat = 'uploads/' . basename($_FILES['contrat']['name']);

                    return 2;
                }

            }
        }
        elseif ((isset($_FILES['cv'])) && ($_FILES['cv']['error'] == 0))
        {

            if (isset($_POST['valider']) and isset($_POST['matricule']) and ($_POST['nom']) and isset($_POST['prenom']) and ($_POST['statut']) and isset($_POST['post']) and ($_POST['assurence']) and
                isset($_POST['date_naissance'])  and isset($_POST['lieu']) and isset($_POST['date_embauche']) and isset($_POST['situation_fam']) and isset($_POST['respo']) and isset($_POST['salaire']) and isset($_POST['projet']) and
                isset($_POST['num_social']) and isset($_POST['date_demission']) and isset($_POST['adresse']) and isset($_POST['tel']) and isset($_POST['email']) and
                isset($_POST['conge']) and isset($_POST['reste_conge']) and isset($_POST['coord_bancaire']) and isset($_POST['comment']))
            {
                $info_fichier = pathinfo($_FILES['cv']['name']);
                $extension_upload = $info_fichier['extension'];
                $extension_autorisées = array('pdf', 'txt', 'docx');
                if (in_array($extension_upload, $extension_autorisées))
                {
                    move_uploaded_file($_FILES['cv']['tmp_name'], 'uploads/cv_' . $_POST['matricule'].'_'.$_POST['nom'].'.'.$extension_upload);
                    $this->setemploye3($_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['statut'], $_POST['post'], $_POST['assurence'],
                        $_POST['date_naissance'],$_POST['lieu'], $_POST['date_embauche'], $_POST['situation_fam'], $_POST['respo'], $_POST['salaire'], $_POST['projet'],
                        $_POST['num_social'], $_POST['date_demission'], $_POST['adresse'], $_POST['tel'], $_POST['email'],
                        $_POST['conge'], $_POST['reste_conge'], $_POST['coord_bancaire'], $_POST['comment']);

                    $this->cv ='uploads/cv_'.$_POST['matricule'].'_'.$_POST['nom'].'.'.$extension_upload;

                    return 3;
                }
                else
                {
                    return -1;
                }

            }

        }
        elseif (isset($_POST['valider']) and isset($_POST['matricule']) and ($_POST['nom']) and isset($_POST['prenom']) and ($_POST['statut']) and isset($_POST['post']) and ($_POST['assurence']) and
            isset($_POST['date_naissance'])  and isset($_POST['lieu']) and isset($_POST['date_embauche']) and isset($_POST['situation_fam']) and isset($_POST['respo']) and isset($_POST['salaire']) and isset($_POST['projet']) and
            isset($_POST['num_social']) and isset($_POST['date_demission']) and isset($_POST['adresse']) and isset($_POST['tel']) and isset($_POST['email']) and
            isset($_POST['conge']) and isset($_POST['reste_conge']) and isset($_POST['coord_bancaire']) and isset($_POST['comment']))
        {



            $this->setemploye3($_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['statut'], $_POST['post'], $_POST['assurence'],
                $_POST['date_naissance'],$_POST['lieu'], $_POST['date_embauche'], $_POST['situation_fam'], $_POST['respo'], $_POST['salaire'], $_POST['projet'],
                $_POST['num_social'], $_POST['date_demission'], $_POST['adresse'], $_POST['tel'], $_POST['email'],
                $_POST['conge'], $_POST['reste_conge'], $_POST['coord_bancaire'], $_POST['comment']);
            return 4;
        }
    }


    public function getemploye()
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM employe');
        $req->execute();

        return $req;

    }
    public function getemploye_id($id)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM employe WHERE (id=?)');
        $req->execute(array($id));
        return $req;

    }
    public function getemploye_matricule($matricule)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM employe WHERE (matricule=?)');
        $req->execute(array($matricule));
        return $req;

    }

     public function getemploye_historique($matricule)
     {
         $bdd=connexion_bdd();
         $req=$bdd->prepare('SELECT * FROM salaire WHERE matricule=?');
         $req->execute(array($matricule));
         return $req;
     }

    public function insert_db_employe()
    {

        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('INSERT INTO employe(matricule,nom,prenom,statut,post,assurence,date_naissance,lieu_naissance,date_embauche,situation_fam,respo,salaire,projet,num_social,contrat,cv,date_demission,adresse,tel,email,conge,reste_conge,coord_bancaire,comment) VALUES (:matricule,:nom,:prenom,:statut,:post,:assurence,:date_naissance,:lieu_naissance,:date_embauche,:situation_fam,:respo,:salaire,:projet,:num_social,:contrat,:cv,:date_demission,:adresse,:tel,:email,:conge,:reste_conge,:coord_bancaire,:comment)');
        $req->execute(array(

            'matricule'=>($this->matricule),
            'nom'=>($this->nom),
            'prenom'=>($this->prenom),
            'statut'=>($this->statut),
            'post'=>($this->post),
            'assurence'=>($this->assurence),
            'date_naissance'=>($this->date_naissance),
            'lieu_naissance'=>($this->lieu_naissance),
            'date_embauche'=>($this->date_embauche),
            'situation_fam'=>($this->situation_fam),
            'respo'=>($this->respo),
            'salaire'=>($this->salaire),
            'projet'=>($this->projet),
            'num_social'=>($this->num_social),
            'contrat'=>($this->contrat),
            'cv'=>($this->cv),
            'date_demission'=>($this->date_demission),
            'adresse'=>($this->adresse),
            'tel'=>($this->tel),
            'email'=>($this->email),
            'conge'=>($this->conge),
            'reste_conge'=>($this->reste_conge),
            'coord_bancaire'=>($this->coord_bancaire),
            'comment'=>($this->comment),
        ));
        $this->comparer_salaire_ajout($this->salaire,$this->matricule);
        return $req;
    }

    public function contrat_modif($id)
    {
        if ((isset($_FILES['contrat'])) && ($_FILES['contrat']['error'] == 0))
        {
            $info_fichier = pathinfo($_FILES['contrat']['name']);
            $extension_upload = $info_fichier['extension'];
            $extension_autorisées = array('pdf', 'jpg', 'jpeg','png','PNG','JPEG','JPG');
            if (in_array($extension_upload, $extension_autorisées))
            {
                move_uploaded_file($_FILES['contrat']['tmp_name'], 'uploads/contrat'.$id.'.'.$extension_upload );
                $bdd=$this->connexion_bdd();
                $req=$bdd->prepare('UPDATE employe SET contrat=? WHERE id=? ');
                $req->execute(array('uploads/contrat'.$id.'.'.$extension_upload,$id));
                return 'success';
            }
            else
            {
                return 'extension';
            }
        }
        else
        {
            return 'file';
        }

    }

    public function modification($id,$critere)
    {

        $bdd=$this->connexion_bdd();
        if ($critere==1)
        {
            $req=$bdd->prepare('UPDATE employe SET matricule=:matricule,nom=:nom,prenom=:prenom,statut=:statut,post=:post,assurence=:assurence,date_naissance=:date_naissance,lieu_naissance=:lieu_naissance,date_embauche=:date_embauche,situation_fam=:situation_fam,respo=:respo,salaire=:salaire,projet=:projet,num_social=:num_social,contrat=:contrat,cv=:cv,date_demission=:date_demission,adresse=:adresse,tel=:tel,email=:email,conge=:conge,reste_conge=:reste_conge,coord_bancaire=:coord_bancaire,comment=:comment WHERE id=:id');
            $req->execute(array(

                'matricule'=>($this->matricule),
                'nom'=>($this->nom),
                'prenom'=>($this->prenom),
                'statut'=>($this->statut),
                'post'=>($this->post),
                'assurence'=>($this->assurence),
                'date_naissance'=>($this->date_naissance),
                'lieu_naissance'=>($this->lieu_naissance),
                'date_embauche'=>($this->date_embauche),
                'situation_fam'=>($this->situation_fam),
                'respo'=>($this->respo),
                'salaire'=>($this->salaire),
                'projet'=>($this->projet),
                'num_social'=>($this->num_social),
                'contrat'=>($this->contrat),
                'cv'=>($this->cv),
                'date_demission'=>($this->date_demission),
                'adresse'=>($this->adresse),
                'tel'=>($this->tel),
                'email'=>($this->email),
                'conge'=>($this->conge),
                'reste_conge'=>($this->reste_conge),
                'coord_bancaire'=>($this->coord_bancaire),
                'comment'=>($this->comment),
                'id'=>($id),
            ));
            $this->comparer_salaire($id,$this->salaire);

        }
        elseif($critere==2)
        {

            $req=$bdd->prepare('UPDATE employe SET matricule=:matricule,nom=:nom,prenom=:prenom,statut=:statut,post=:post,assurence=:assurence,date_naissance=:date_naissance,lieu_naissance=:lieu_naissance,date_embauche=:date_embauche,situation_fam=:situation_fam,respo=:respo,salaire=:salaire,projet=:projet,num_social=:num_social,contrat=:contrat,date_demission=:date_demission,adresse=:adresse,tel=:tel,email=:email,conge=:conge,reste_conge=:reste_conge,coord_bancaire=:coord_bancaire,comment=:comment WHERE id=:id');
            $req->execute(array(

                'matricule'=>($this->matricule),
                'nom'=>($this->nom),
                'prenom'=>($this->prenom),
                'statut'=>($this->statut),
                'post'=>($this->post),
                'assurence'=>($this->assurence),
                'date_naissance'=>($this->date_naissance),
                'lieu_naissance'=>($this->lieu_naissance),
                'date_embauche'=>($this->date_embauche),
                'situation_fam'=>($this->situation_fam),
                'respo'=>($this->respo),
                'salaire'=>($this->salaire),
                'projet'=>($this->projet),
                'num_social'=>($this->num_social),
                'contrat'=>($this->contrat),
                'date_demission'=>($this->date_demission),
                'adresse'=>($this->adresse),
                'tel'=>($this->tel),
                'email'=>($this->email),
                'conge'=>($this->conge),
                'reste_conge'=>($this->reste_conge),
                'coord_bancaire'=>($this->coord_bancaire),
                'comment'=>($this->comment),
                'id'=>($id),
            ));
            $this->comparer_salaire($id,$this->salaire);
        }
        elseif($critere==3)
        {
            $req=$bdd->prepare('UPDATE employe SET matricule=:matricule,nom=:nom,prenom=:prenom,statut=:statut,post=:post,assurence=:assurence,date_naissance=:date_naissance,lieu_naissance=:lieu_naissance,date_embauche=:date_embauche,situation_fam=:situation_fam,respo=:respo,salaire=:salaire,projet=:projet,num_social=:num_social,cv=:cv,date_demission=:date_demission,adresse=:adresse,tel=:tel,email=:email,conge=:conge,reste_conge=:reste_conge,coord_bancaire=:coord_bancaire,comment=:comment WHERE id=:id');
            $req->execute(array(

                'matricule'=>($this->matricule),
                'nom'=>($this->nom),
                'prenom'=>($this->prenom),
                'statut'=>($this->statut),
                'post'=>($this->post),
                'assurence'=>($this->assurence),
                'date_naissance'=>($this->date_naissance),
                'lieu_naissance'=>($this->lieu_naissance),
                'date_embauche'=>($this->date_embauche),
                'situation_fam'=>($this->situation_fam),
                'respo'=>($this->respo),
                'salaire'=>($this->salaire),
                'projet'=>($this->projet),
                'num_social'=>($this->num_social),
                'cv'=>($this->cv),
                'date_demission'=>($this->date_demission),
                'adresse'=>($this->adresse),
                'tel'=>($this->tel),
                'email'=>($this->email),
                'conge'=>($this->conge),
                'reste_conge'=>($this->reste_conge),
                'coord_bancaire'=>($this->coord_bancaire),
                'comment'=>($this->comment),
                'id'=>($id),
            ));
            $this->comparer_salaire($id,$this->salaire);
        }
        elseif($critere==4)
        {

            $req=$bdd->prepare('UPDATE employe SET matricule=:matricule,nom=:nom,prenom=:prenom,statut=:statut,post=:post,assurence=:assurence,date_naissance=:date_naissance,lieu_naissance=:lieu_naissance,date_embauche=:date_embauche,situation_fam=:situation_fam,respo=:respo,salaire=:salaire,projet=:projet,num_social=:num_social,date_demission=:date_demission,adresse=:adresse,tel=:tel,email=:email,conge=:conge,reste_conge=:reste_conge,coord_bancaire=:coord_bancaire,comment=:comment WHERE id=:id');
            $req->execute(array(

                'matricule'=>($this->matricule),
                'nom'=>($this->nom),
                'prenom'=>($this->prenom),
                'statut'=>($this->statut),
                'post'=>($this->post),
                'assurence'=>($this->assurence),
                'date_naissance'=>($this->date_naissance),
                'lieu_naissance'=>($this->lieu_naissance),
                'date_embauche'=>($this->date_embauche),
                'situation_fam'=>($this->situation_fam),
                'respo'=>($this->respo),
                'salaire'=>($this->salaire),
                'projet'=>($this->projet),
                'num_social'=>($this->num_social),
                'date_demission'=>($this->date_demission),
                'adresse'=>($this->adresse),
                'tel'=>($this->tel),
                'email'=>($this->email),
                'conge'=>($this->conge),
                'reste_conge'=>($this->reste_conge),
                'coord_bancaire'=>($this->coord_bancaire),
                'comment'=>($this->comment),
                'id'=>$id,
            ));
            $this->comparer_salaire($id,$this->salaire);
        }


    }

    private function comparer_salaire($id,$nouveau_salaire)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM employe WHERE id=?');
        $req->execute(array($id));
        $salaire=$req->fetch();
        if ($salaire['salaire']==$nouveau_salaire)
        {
            $req1=$bdd->prepare('INSERT INTO salaire (matricule,date,montant) VALUES (:matricule,:date,:montant)');
            $req1->execute(array(
                'matricule'=>$salaire['matricule'],
                'date'=>date("Y-m-d"),
                'montant'=>$nouveau_salaire,

            ));
        }

    }

    private function comparer_salaire_ajout($nouveau_salaire,$matricule)
    {
        $bdd=$this->connexion_bdd();

        $req1=$bdd->prepare('INSERT INTO salaire (matricule,date,montant) VALUES (:matricule,:date,:montant)');
        $req1->execute(array(
            'matricule'=>$matricule,
            'date'=>date("Y-m-d"),
            'montant'=>$nouveau_salaire,

        ));


    }

    public function affiche()
    {
        echo 'matricule '.$this->matricule.'<br>';
        echo 'nom '.$this->nom.'<br>';
        echo 'prenom '.$this->prenom.'<br>';
        echo 'statut '.$this->statut.'<br>';
        echo 'post '.$this->post.'<br>';
        echo 'assurence '.$this->assurence.'<br>';
        echo 'date_naissance '.$this->date_naissance.'<br>';
        echo 'date_embauche '.$this->date_embauche.'<br>';
        echo 'situation_fam '.$this->situation_fam.'<br>';
        echo 'respo '.$this->respo.'<br>';
        echo 'salaire '.$this->salaire.'<br>';
        echo 'projet '.$this->projet.'<br>';
        echo 'num_social '.$this->num_social.'<br>';
        echo 'contrat '.$this->contrat.'<br>';
        echo 'cv '.$this->cv.'<br>';
        echo 'date_demission '.$this->date_demission.'<br>';
        echo 'adresse '.$this->adresse.'<br>';
        echo 'tel '.$this->tel.'<br>';
        echo 'email '.$this->email.'<br>';
        echo 'conge '.$this->conge.'<br>';
        echo 'reste_conge '.$this->reste_conge.'<br>';
        echo 'coord_bancaire '.$this->coord_bancaire.'<br>';
        echo 'comment '.$this->comment.'<br>';

    }

    function desactiveEmploye($id)
    {
        $bdd=$this->connexion_bdd();
        $x="Inactif";
        $req=$bdd->prepare('UPDATE employe SET statut= :statut , date_demission= :date_demission WHERE id= :id');
        $req->execute(array(
            'statut'=>$x,
            'date_demission'=>date('Y-m-d H:i:s'),
            'id'=>$id,
            ));

    }

    function reactiveEmploye($id)
    {
        $bdd=$this->connexion_bdd();
        $x="Actif";
        $req=$bdd->prepare('UPDATE employe SET statut= :statut , date_embauche= :date_embauche WHERE id= :id');
        $req->execute(array(
            'statut'=>$x,
            'date_embauche'=>date('Y-m-d H:i:s'),
            'id'=>$id,
        ));

    }


    function replace_extension($filename, $new_extension)
    {
        $info = pathinfo($filename);
        return $info['filename'] . '.' . $new_extension;
    }

    public function genererAttestation()
    {
        $bdd=connexion_bdd();
        $entreprise=new Entreprise();
        $entreprises=$entreprise->get_entreprise();
        $entreprise1=$entreprises->fetch();

        //Open the model
        $zip = new ZipArchive;
        $zip->open("templates/templateAttestation.zip");
        //Make a copy
        $zip2 = new ZipArchive;
        if (!copy("templates/templateAttestation.zip", "generated/Attestation.zip")) {
            echo 'failed to copy';
        }
        else
        {
            //Open the copy
            $fullpath = "generated/Attestation.zip";
            if ($zip2->open($fullpath) == true) {

                //Open the document.xml file and replace whatever u want :)
                $key_file_name = 'word/document.xml';
                $message = $zip2->getFromName($key_file_name);

                $timestamp = date('Y-m-d');

                $message = str_replace("WILAYAE", $entreprise1['wilaya'], $message);
                $message = str_replace("WILAYA",$this->lieu_naissance , $message);
                $message = str_replace("DATEACT", $timestamp, $message);
                $message = str_replace("NOMETPRENOMGERANT", $entreprise1['nom_gerant'], $message);
                $message = str_replace("NOMPRENOMEMPLOYE", $this->nom." ".$this->prenom, $message);
                $message = str_replace("DATEDENAISSANCE", $this->date_naissance, $message);
                $message = str_replace("DATED’EMBAUCHE",$this->date_embauche, $message);
                $message = str_replace("POSTE", $this->post, $message);
                $message = str_replace("RAISONSOCIALE",$entreprise1['nom_entreprise'], $message);

                //Save the changes
                $zip2->addFromString($key_file_name, $message);

                //Open the header and also replace whatever u want

                $key_file_name = 'word/header1.xml';
                $message = $zip2->getFromName($key_file_name);

                $message = str_replace("WILAYAE", $entreprise1['wilaya'], $message);
                $message = str_replace("RC", $entreprise1['RC'], $message);
                $message = str_replace("RAISONSOCIALE",$entreprise1['nom_entreprise'], $message);
                $message = str_replace("SPACIALITE", $entreprise1['specialite'], $message);

                //Save the changes
                $zip2->addFromString($key_file_name, $message);

                //And finally Open the footer and also replace whatever u want

                $key_file_name = 'word/footer1.xml';
                $message = $zip2->getFromName($key_file_name);

                $message = str_replace("RAISONSOCIALE",$entreprise1['nom_entreprise'], $message);

                //Save the changes
                $zip2->addFromString($key_file_name, $message);

                //Replace the logo if u need to
                //Delete the old one
                $zip2->deleteName('word/media/image1.jpeg');
                //Add a new one :)
                $zip2->addFile($entreprise1['logo'], 'word/media/image1.png');

                //Close ur zip file
                $zip2->close();

                //Change the extension into docx
                $new_name = $this->replace_extension("generated/Attestation.zip", "docx");

                rename("generated/Attestation.zip", "generated/" . $new_name);

                //Salam 3likom ;)

            }
        }

    }

    public function genererCertificat()
    {
        $bdd=connexion_bdd();
        $entreprise=new Entreprise();
        $entreprises=$entreprise->get_entreprise();
        $entreprise1=$entreprises->fetch();

        //Open the model
        $zip = new ZipArchive;
        $zip->open("templates/templateCertificat.zip");
        //Make a copy
        $zip2 = new ZipArchive;
        if (!copy("templates/templateCertificat.zip", "generated/Certificat.zip")) {
            echo 'failed to copy';
        }
        else
        {
            //Open the copy
            $fullpath = "generated/Certificat.zip";
            if ($zip2->open($fullpath) == true) {

                //Open the document.xml file and replace whatever u want :)
                $key_file_name = 'word/document.xml';
                $message = $zip2->getFromName($key_file_name);

                $timestamp = date('Y-m-d');

                $message = str_replace("WILAYAE", $entreprise1['wilaya'], $message);
                $message = str_replace("WILAYA", $this->lieu_naissance, $message);
                $message = str_replace("DATEACT", $timestamp, $message);
                $message = str_replace("NOMETPRENOMGERANT", $entreprise1['nom_gerant'], $message);
                $message = str_replace("NOMPRENOMEMPLOYE", $this->nom." ".$this->prenom, $message);
                $message = str_replace("DATEDENAISSANCE", $this->date_naissance, $message);
                $message = str_replace("DATED’EMBAUCHE",$this->date_embauche, $message);
                $message = str_replace("DATEDEMISSION",$this->date_demission, $message);
                $message = str_replace("POSTE", $this->post, $message);
                $message = str_replace("RAISONSOCIALE",$entreprise1['nom_entreprise'], $message);

                //Save the changes
                $zip2->addFromString($key_file_name, $message);

                //Open the header and also replace whatever u want

                $key_file_name = 'word/header1.xml';
                $message = $zip2->getFromName($key_file_name);

                $message = str_replace("WILAYAE", $entreprise1['wilaya'], $message);
                $message = str_replace("RC", $entreprise1['RC'], $message);
                $message = str_replace("RAISONSOCIALE",$entreprise1['nom_entreprise'], $message);
                $message = str_replace("SPACIALITE", $entreprise1['specialite'], $message);

                //Save the changes
                $zip2->addFromString($key_file_name, $message);

                //And finally Open the footer and also replace whatever u want

                $key_file_name = 'word/footer1.xml';
                $message = $zip2->getFromName($key_file_name);

                $message = str_replace("RAISONSOCIALE",$entreprise1['nom_entreprise'], $message);

                //Save the changes
                $zip2->addFromString($key_file_name, $message);

                //Replace the logo if u need to
                //Delete the old one
                $zip2->deleteName('word/media/image1.jpeg');
                //Add a new one :)
                $zip2->addFile($entreprise1['logo'], 'word/media/image1.png');

                //Close ur zip file
                $zip2->close();

                //Change the extension into docx
                $new_name = $this->replace_extension("generated/Certificat.zip", "docx");

                rename("generated/Certificat.zip", "generated/" . $new_name);

                //Salam 3likom ;)

            }
        }
    }

        public function genererContrat()
        {
            $bdd=connexion_bdd();
            $entreprise=new Entreprise();
            $entreprises=$entreprise->get_entreprise();
            $entreprise1=$entreprises->fetch();

            //Open the model
            $zip = new ZipArchive;
            $zip->open("templates/templateContrat.zip");
            //Make a copy
            $zip2 = new ZipArchive;
            if (!copy("templates/templateContrat.zip", "generated/Contrat.zip")) {
                echo 'failed to copy';
            }
            else
            {
                //Open the copy
                $fullpath = "generated/Contrat.zip";
                if ($zip2->open($fullpath) == true) {

                    //Open the document.xml file and replace whatever u want :)
                    $key_file_name = 'word/document.xml';
                    $message = $zip2->getFromName($key_file_name);

                    $timestamp = date('Y-m-d');

                    $message = str_replace("WILAYAE", $entreprise1['wilaya'], $message);
                    $message = str_replace("ADRESSE", $entreprise1['wilaya'], $message);
                    $message = str_replace("MATRICULE",$this->matricule, $message);
                    $message = str_replace("WILAYA", $this->lieu_naissance, $message);
                    $message = str_replace("DATEACT", $timestamp, $message);
                    $message = str_replace("NOMETPRENOMGERANT", $entreprise1['nom_gerant'], $message);
                    $message = str_replace("NOMPRENOMEMPLOYE", $this->nom." ".$this->prenom, $message);
                    $message = str_replace("DATEDENAISSANCE", $this->date_naissance, $message);
                    $message = str_replace("DATEEMBAUCHE",$this->date_embauche, $message);
                    $message = str_replace("DATEDEMISSION",$this->date_demission, $message);
                    $message = str_replace("POSTE", $this->post, $message);
                    $message = str_replace("RAISONSOCIALE",$entreprise1['nom_entreprise'], $message);
                    $message = str_replace("RCFISCAL", $entreprise1['RC'], $message);
                    $message = str_replace("SPACIALITE", $entreprise1['specialite'], $message);
                    $s=$this->salaire*12;
                    $message = str_replace("SALAIREANNUEL", $s, $message);
                    $message = str_replace("SALAIRE", $this->salaire, $message);


                    //Save the changes
                    $zip2->addFromString($key_file_name, $message);



                    //And finally Open the footer and also replace whatever u want

                    $key_file_name = 'word/footer2.xml';
                    $message = $zip2->getFromName($key_file_name);

                    $message = str_replace("RAISONSOCIALE",$entreprise1['nom_entreprise'], $message);

                    //Save the changes
                    $zip2->addFromString($key_file_name, $message);

                    //Replace the logo if u need to
                    //Delete the old one
                    $zip2->deleteName('word/media/image1.jpeg');
                    //Add a new one :)
                    $zip2->addFile($entreprise1['logo'], 'word/media/image1.png');

                    //Close ur zip file
                    $zip2->close();

                    //Change the extension into docx
                    $new_name = $this->replace_extension("generated/Contrat.zip", "docx");

                    rename("generated/Contrat.zip", "generated/" . $new_name);

                    //Salam 3likom ;)
             }
            }
        }

        public static function totalEmploye()
        {
            $bdd=connexion_bdd();
            $req=$bdd->prepare('SELECT * FROM employe' );
            $req->execute();
            return $req->rowCount();
        }

        public static function moyenneSalaire()
        {
            $total=0;
            $bdd=connexion_bdd();
            $req=$bdd->prepare('SELECT salaire FROM employe');
            $req->execute();
            while ($donnee=$req->fetch())
            {
                $total=$total+$donnee['salaire'];
            }

            return $total/self::totalEmploye();
        }

        public static function getAge($date_naissance)
        {
           return round ((-strtotime($date_naissance)+strtotime(date('Y-m-d H:i:s')))/(24*3600*365),0);

        }

        public static function getAges()
        {
            $ages['16-20']=0;$ages['20-25']=0;$ages['25-30']=0;$ages['30-40']=0;$ages['40-50']=0;$ages['50-']=0;
            $bdd=connexion_bdd();
            $req=$bdd->prepare('SELECT * FROM employe ');
            $req->execute();
            while ($employe=$req->fetch())
            {
                if(self::getAge($employe['date_naissance'])<=20) $ages['16-20']++;
                if ((self::getAge($employe['date_naissance'])<=25)&&(self::getAge($employe['date_naissance'])>20)) $ages['20-25']++;
                if ((self::getAge($employe['date_naissance'])<=30)&&(self::getAge($employe['date_naissance'])>25)) $ages['25-30']++;
                if ((self::getAge($employe['date_naissance'])<=40)&&(self::getAge($employe['date_naissance'])>30)) $ages['30-40']++;
                if ((self::getAge($employe['date_naissance'])<=50)&&(self::getAge($employe['date_naissance'])>40)) $ages['40-50']++;
                if (self::getAge($employe['date_naissance'])>50)$ages['50-']++;
            }

            return $ages;

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


}