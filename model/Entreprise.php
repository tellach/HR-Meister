<?php
/**
 * Created by PhpStorm.
 * User: ga_na
 * Date: 2/17/2018
 * Time: 11:41 AM
 */

class Entreprise
{
    private $nom_entreprise;
    private $Raison_social;
    private $specialite;
    private $RC;
    private $adresse;
    private $mail;
    private $num;
    private $url;
    private $msg_acceuil;
    private $nom_gerant;
    private $mail_gerant;
    private $num_gerant;
    private $logo;

    public function setEntreprise_from_post()
    {
        if ((isset($_POST['nom_entreprise']))&&(isset($_POST['Raison_social']))&&(isset($_POST['mail']))&&(isset($_POST['num']))&&(isset($_POST['url']))&&(isset($_POST['nom_gerant']))&&(isset($_POST['mail_gerant']))&&(isset($_POST['num_gerant']))&&(isset($_POST['msg_acceuil']))&&(isset($_FILES['f']))&&($_FILES['f']['error']==0))
        {
            $info_fichier=pathinfo($_FILES['f']['name']);
            $extension_upload=$info_fichier['extension'];
            $extension_autorisées=array('jpg','jpeg','png');
            if(in_array($extension_upload,$extension_autorisées))
            {
                move_uploaded_file($_FILES['f']['tmp_name'], 'uploads/' .basename($_FILES['f']['name']));

                $this->nom_entreprise=strip_tags($_POST['nom_entreprise']);
                $this->Raison_social=strip_tags($_POST['Raison_social']);
                $this->mail=strip_tags($_POST['mail']);
                $this->num=strip_tags($_POST['num']);
                $this->url=strip_tags($_POST['url']);
                $this->msg_acceuil=strip_tags($_POST['msg_acceuil']);
                $this->nom_gerant=strip_tags($_POST['nom_gerant']);
                $this->mail_gerant=strip_tags($_POST['mail_gerant']);
                $this->num_gerant=strip_tags($_POST['num_gerant']);
                $this->logo='uploads/' .basename($_FILES['f']['name']);

                return 1;//Tout va bien ..

            }
            else
            {
                return 0;//L'un des parametres manque
            }
        }
        else
        {
            return 0;//L'un des parametres manque
        }

    }
    public function set_entreprise()
    {

        if ((isset($_FILES['f'])) && ($_FILES['f']['error'] == 0)) {

            if ((isset($_POST['nom_entreprise'])) && (isset($_POST['Raison_social']))&& (isset($_POST['RC']))&& (isset($_POST['specialite']))&& (isset($_POST['wilaya'])) && (isset($_POST['mail'])) && (isset($_POST['num'])) && (isset($_POST['url'])) && (isset($_POST['nom_gerant'])) && (isset($_POST['mail_gerant'])) && (isset($_POST['num_gerant'])) && (isset($_POST['msg_acceuil']))) {
                $info_fichier = pathinfo($_FILES['f']['name']);
                $extension_upload = $info_fichier['extension'];
                $extension_autorisées = array('jpeg','JPEG');
                if (in_array($extension_upload, $extension_autorisées)) {
                    move_uploaded_file($_FILES['f']['tmp_name'], 'uploads/' . basename($_FILES['f']['name']));

                    $this->nom_entreprise = strip_tags($_POST['nom_entreprise']);
                    $this->Raison_social = strip_tags($_POST['Raison_social']);
                    $this->RC = strip_tags($_POST['RC']);
                    $this->adresse = strip_tags($_POST['wilaya']);
                    $this->specialite = strip_tags($_POST['specialite']);
                    $this->mail = strip_tags($_POST['mail']);
                    $this->num = strip_tags($_POST['num']);
                    $this->url = strip_tags($_POST['url']);
                    $this->msg_acceuil = strip_tags($_POST['msg_acceuil']);
                    $this->nom_gerant = strip_tags($_POST['nom_gerant']);
                    $this->mail_gerant = strip_tags($_POST['mail_gerant']);
                    $this->num_gerant = strip_tags($_POST['num_gerant']);
                    $this->logo = 'uploads/' . basename($_FILES['f']['name']);

                    return "avec_ficher";


                }
                else
                {
                    return 'extension';
                }
            }
        }
        else {

            if ((isset($_POST['nom_entreprise'])) && (isset($_POST['Raison_social']))&& (isset($_POST['RC']))&& (isset($_POST['specialite']))&& (isset($_POST['wilaya'])) && (isset($_POST['mail'])) && (isset($_POST['num'])) && (isset($_POST['url'])) && (isset($_POST['nom_gerant'])) && (isset($_POST['mail_gerant'])) && (isset($_POST['num_gerant'])) && (isset($_POST['msg_acceuil']))) {


                $this->nom_entreprise = strip_tags($_POST['nom_entreprise']);
                $this->Raison_social = strip_tags($_POST['Raison_social']);
                $this->RC = strip_tags($_POST['RC']);
                $this->adresse = strip_tags($_POST['wilaya']);
                $this->specialite = strip_tags($_POST['specialite']);
                $this->mail = strip_tags($_POST['mail']);
                $this->num = strip_tags($_POST['num']);
                $this->url = strip_tags($_POST['url']);
                $this->msg_acceuil = strip_tags($_POST['msg_acceuil']);
                $this->nom_gerant = strip_tags($_POST['nom_gerant']);
                $this->mail_gerant = strip_tags($_POST['mail_gerant']);
                $this->num_gerant = strip_tags($_POST['num_gerant']);

                return "sans_fichier";


            }
        }
    }

    public function insertEntreprise_bdd()
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('INSERT INTO parametres_entreprise(nom_entreprise,raison_social,mail,num,site_web,msg_acceuil,nom_gerant,mail_gerant,num_gerant,logo) VALUES (:nom_entreprise,:raison_social,:mail,:num,:site_web,:msg_acceuil,:nom_gerant,:mail_gerant,:num_gerant,:logo)') ;
        $req->execute(array(
            'nom_entreprise'=>$this->nom_entreprise,
            'raison_social'=>$this->Raison_social,
            'mail'=>$this->mail,
            'num'=>$this->num,
            'site_web'=>$this->url,
            'msg_acceuil'=>$this->msg_acceuil,
            'nom_gerant'=>$this->nom_gerant,
            'mail_gerant'=>$this->mail_gerant,
            'num_gerant'=>$this->num_gerant,
            'logo'=>$this->logo,
        ));

    }

    public function modification_entreprise2($critere)
    {
        $id=1;
        if ($critere=="avec_ficher")
        {
            $bdd=$this->connexion_bdd();
            $req=$bdd->prepare('UPDATE parametres_entreprise SET nom_entreprise=:nom_entreprise,raison_social=:raison_social,mail=:mail,num=:num,site_web=:site_web,msg_acceuil=:msg_acceuil,nom_gerant=:nom_gerant,mail_gerant=:mail_gerant,num_gerant=:num_gerant,logo=:logo,specialite=:specialite,RC=:RC,wilaya=:wilaya WHERE id=:id') ;
            $req->execute(array(
                'nom_entreprise'=>$this->nom_entreprise,
                'raison_social'=>$this->Raison_social,
                'mail'=>$this->mail,
                'num'=>$this->num,
                'site_web'=>$this->url,
                'msg_acceuil'=>$this->msg_acceuil,
                'nom_gerant'=>$this->nom_gerant,
                'mail_gerant'=>$this->mail_gerant,
                'num_gerant'=>$this->num_gerant,
                'logo'=>$this->logo,
                'specialite'=>$this->specialite,
                'RC'=>$this->RC,
                'wilaya'=>$this->adresse,
                'id' => $id,
            ));
        }
        if ($critere=="sans_fichier")
        {

            $bdd=$this->connexion_bdd();
            $req=$bdd->prepare('UPDATE parametres_entreprise SET nom_entreprise=:nom_entreprise,raison_social=:raison_social,mail=:mail,num=:num,site_web=:site_web,msg_acceuil=:msg_acceuil,nom_gerant=:nom_gerant,mail_gerant=:mail_gerant,num_gerant=:num_gerant,specialite=:specialite,RC=:RC,wilaya=:wilaya WHERE id=:id ') ;
            $req->execute(array(
                'nom_entreprise'=>$this->nom_entreprise,
                'raison_social'=>$this->Raison_social,
                'mail'=>$this->mail,
                'num'=>$this->num,
                'site_web'=>$this->url,
                'msg_acceuil'=>$this->msg_acceuil,
                'nom_gerant'=>$this->nom_gerant,
                'mail_gerant'=>$this->mail_gerant,
                'num_gerant'=>$this->num_gerant,
                'specialite'=>$this->specialite,
                'RC'=>$this->RC,
                'wilaya'=>$this->adresse,
                'id' => $id,
            ));
        }
    }

    public function get_entreprise()
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM parametres_entreprise');
        $req->execute();

        return $req;
    }

    /**
     * @return mixed
     */
    public function getNomEntreprise()
    {
        return $this->nom_entreprise;
    }

    /**
     * @return mixed
     */
    public function getRaisonSocial()
    {
        return $this->Raison_social;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getMsgAcceuil()
    {
        return $this->msg_acceuil;
    }

    /**
     * @return mixed
     */
    public function getNomGerant()
    {
        return $this->nom_gerant;
    }

    /**
     * @return mixed
     */
    public function getMailGerant()
    {
        return $this->mail_gerant;
    }

    /**
     * @return mixed
     */
    public function getNumGerant()
    {
        return $this->num_gerant;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    public function affichage()
    {
        echo 'nom_entreprise '.$this->nom_entreprise.'<br>';
        echo 'raison_social '.$this->Raison_social.'<br>';
        echo 'mail '.$this->mail.'<br>';
        echo 'num '.$this->num.'<br>';
        echo 'site_web '.$this->url.'<br>';
        echo 'msg_acceuil '.$this->msg_acceuil.'<br>';
        echo 'nom_gerant '.$this->nom_gerant.'<br>';
        echo 'mail_gerant '.$this->mail_gerant.'<br>';
        echo  'num_gerant '.$this->num_gerant.'<br>';
        echo 'logo '.$this->logo.'<br>';
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


