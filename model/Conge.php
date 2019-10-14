<?php
/**
 * Created by PhpStorm.
 * User: ga_na
 * Date: 2/23/2018
 * Time: 2:54 PM
 */
require_once ('Utilitaire.php');
class Conge
{
    private $matricule;
    private $type_conge;
    private $date_debut;
    private $date_fin;
    private $demande_conge;

    public function setConge($matricule,$type_conge,$date_debut,$date_fin,$demand_conge)
    {
        $this->matricule=$matricule;
        $this->type_conge=$type_conge;
        $this->date_debut=$date_debut;
        $this->date_fin=$date_fin;
        $this->demande_conge=$demand_conge;
    }


    public function ajout_conge()
    {
        //$bdd=Utilitaire::connexion_bdd();
        $bdd=new PDO('mysql:host=localhost;dbname=grh;charset=utf8', 'root', '');

        //$bdd->exec('INSERT INTO conge(matricule, date_debut, date_fin, type_conge, demande_conge) VALUES (\'.$this->matricule.'\')')
        $req=$bdd->prepare('INSERT INTO conge(matricule,date_debut,date_fin,type_conge,demande_conge)VALUES(:matricule,:date_debut,:date_fin,:type_conge,:demande_conge)');

        $req->execute(array(
        'matricule'=>$this->matricule,
        'date_debut'=>$this->date_debut,
        'date_fin'=>$this->date_fin,
        'type_conge'=>$this->type_conge,
        'demande_conge'=>$this->demande_conge,
        ));
        move_uploaded_file($_FILES['f']['tmp_name'], 'uploads/' .basename($_FILES['f']['name']));
    }

    public function setConge_from_post()
    {

        if (isset($_POST['matricule'])&&isset($_POST['type_conge'])&&isset($_POST['date_debut'])&&isset($_POST['date_fin'])&&isset($_FILES['f'])&&($_FILES['f']['error']==0))
        {
            $info_fichier=pathinfo($_FILES['f']['name']);
            $extension_upload=$info_fichier['extension'];
            $extension_autorisées=array('pdf','docx','txt');
            if(in_array($extension_upload,$extension_autorisées))
            {
                //move_uploaded_file($_FILES['f']['tmp_name'], 'uploads/' .basename($_FILES['f']['name']));
                $this->matricule=strip_tags($_POST['matricule']);
                $this->type_conge=strip_tags($_POST['type_conge']);
                $this->date_debut=strip_tags($_POST['date_debut']);
                $this->date_fin=strip_tags($_POST['date_fin']);
                $this->demande_conge='../uploads/' .basename($_FILES['f']['name']);

                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }


    public function validation_conge()
    {
        $coupure=0;
        $bdd=Utilitaire::connexion_bdd();
        $req=$bdd->prepare('SELECT reste_conge FROM employe WHERE matricule=?');
        $req->execute(array($this->matricule));
        $num_of_rows=$req->rowCount();
        if ($num_of_rows==1)
        {
            $donnee=$req->fetch();
            $date1=strtotime($this->date_debut);
            $date2=strtotime($this->date_fin);
            $reste=$donnee['reste_conge']*24*3600;
            $date_actuelle=strtotime(date('Y-m-d H:i:s'));
            if (($date2>$date1)&&($date_actuelle<=$date1))
            {
                if(($this->type_conge==1 && $reste>($date2-$date1)||($this->type_conge!=1)))
                {
                    $req->closeCursor();
                    $req=$bdd->prepare('SELECT date_debut,date_fin FROM conge WHERE matricule=?');
                    $req->execute(array($this->matricule));
                    while (($donnee2=$req->fetch()))
                    {
                        if (($this->date_fin>$donnee2['date_debut']&&$this->date_fin<$donnee2['date_fin'])||($this->date_debut>$donnee2['date_debut']&&$this->date_debut<$donnee2['date_fin']))
                        {
                            $coupure=1;
                        }
                    }
                    if ($coupure==0)
                    {
                        return "valide";
                    }
                    else
                    {
                        return "coupure";
                    }
                }
                else{
                    return "reste";
                }
            }
            else
            {
                if ($date2<$date1) return "fin>debut";
                if ($date_actuelle>$date1) return "actuelle>debut";
            }

        }
        else {
            return "employe";
        }

    }

    public function soustraction_reste_conge()
    {
        $bdd=Utilitaire::connexion_bdd();
        $req=$bdd->prepare('SELECT reste_conge FROM employe WHERE matricule=?');
        $req->execute(array($this->matricule));
        $num_of_rows=$req->rowCount();
        if ($num_of_rows==1)
        {
            $donnee=$req->fetch();
            $reste=$donnee['reste_conge'];
            $req->closeCursor();
            $req=$bdd->prepare('UPDATE employe SET reste_conge=?  WHERE matricule=?');
            $req->execute(array(
                ($reste*24*3600-(strtotime($this->date_fin)-strtotime($this->date_debut)))/(24*3600),
                $this->matricule
            ));
        }
        else {
            return -1;
        }

    }

    public function getTypeConge()
    {
        return $this->type_conge;
    }

    public function getConge($id)
    {
        $bdd=connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM CONGE WHERE id=?');
        $req->execute(array($id));

        return $req;

    }

    public static function getConges_pass()
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  conge.id AS id_conge , conge.matricule AS matricule ,  employe.nom AS nom , employe.prenom AS prenom  , conge.type_conge AS type_conge , conge.date_debut AS date_debut ,conge.date_fin AS date_fin 
                                        FROM `conge`
                                        INNER JOIN `employe`
                                        ON `conge`.`matricule` = `employe`.`matricule`    
                                        WHERE `conge`.`date_fin`< ?         ');
        $reponse->execute(array(date('Y-m-d H:i:s')));
        return $reponse;
    }

    public static function getConges_prez()
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  conge.id AS id_conge , conge.matricule AS matricule , employe.nom AS nom , employe.prenom AS prenom  , conge.type_conge AS type_conge , conge.date_debut AS date_debut ,conge.date_fin AS date_fin 
                                        FROM `conge`
                                        INNER JOIN `employe`
                                        ON `conge`.`matricule` = `employe`.`matricule`  
                                        WHERE `conge`.`date_debut`< ? AND `conge`.`date_fin`>?            ');
        $reponse->execute(array(date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
        return $reponse;
    }

    public static function getConges_venir()
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  conge.id AS id_conge ,conge.matricule AS matricule , employe.nom AS nom , employe.prenom AS prenom  , conge.type_conge AS type_conge , conge.date_debut AS date_debut ,conge.date_fin AS date_fin 
                                        FROM `conge`
                                        INNER JOIN `employe`
                                        ON `conge`.`matricule` = `employe`.`matricule` 
                                        WHERE `conge`.`date_debut`> ?             ');
        $reponse->execute(array(date('Y-m-d H:i:s')));
        return $reponse;
    }

    public static function getConges()
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  conge.id AS id_conge ,conge.matricule AS matricule , employe.nom AS nom , employe.prenom AS prenom  , conge.type_conge AS type_conge , conge.date_debut AS date_debut ,conge.date_fin AS date_fin 
                                        FROM `conge`
                                        INNER JOIN `employe`
                                        ON `conge`.`matricule` = `employe`.`matricule` 
                                                    ');
        $reponse->execute();
        return $reponse;
    }


    public static function getConge_matricule($matricule)
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  conge.id AS id_conge , conge.matricule AS matricule ,  employe.nom AS nom , employe.prenom AS prenom  , conge.type_conge AS type_conge , conge.date_debut AS date_debut ,conge.date_fin AS date_fin 
                                        FROM `conge`
                                        INNER JOIN `employe`
                                        ON `conge`.`matricule` = `employe`.`matricule`    
                                        WHERE `conge`.`matricule`= ?         ');
        $reponse->execute(array($matricule));
        return $reponse;
    }

    public static function getCongesByMatricule($matricule)
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  conge.id AS id_conge , employe.nom AS nom , employe.prenom AS prenom  , conge.type_conge AS type_conge , conge.date_debut AS date_debut ,conge.date_fin AS date_fin 
                                        FROM `conge`
                                        INNER JOIN `employe`
                                        ON `conge`.`matricule` =?              ');
        $reponse->execute(array($matricule));
        return $reponse;
    }

    public static function getCongesByDate($date_debut,$date_fin)
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  conge.id AS id_conge , employe.nom AS nom , employe.prenom AS prenom  , conge.type_conge AS type_conge , conge.date_debut AS date_debut ,conge.date_fin AS date_fin 
                                        FROM `conge`
                                        INNER JOIN `employe`
                                        ON `conge`.`matricule` =`employe`.`matricule`
                                        WHERE `conge`.`date_debut`<? && `conge`.`date_debut`>?
                                                     ');
        $reponse->execute(array($date_debut,$date_fin));
        return $reponse;
    }


    public function supp_conge($id)
    {
        $bdd=Utilitaire::connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM conge WHERE id=? ');
        $req->execute(array($id));
        $num_of_rows=$req->rowCount();
        if ($num_of_rows==1)
        {

            $donnee=$req->fetch();
            $this->matricule = $donnee['matricule'];
            $this->type_conge = $donnee['type_conge'];
            $this->date_debut = $donnee['date_debut'];
            $this->date_fin =$donnee['date_fin'];
            $this->demande_conge = $donnee['demande_conge'];
            $date1=strtotime($this->date_debut);
            $date2=strtotime($this->date_fin);
            $date_actuelle=strtotime(date('Y-m-d H:i:s'));
            $reste=$donnee['reste_conge'];
            if (($date2>$date1)&&($date1>$date_actuelle))
            {

                $req->closeCursor();
                if (strtotime($this->date_fin)>time())//Le congé a supprimer n'est pas encore terminé , on doit rajouter à l'employé les jours non consomés
                {
                    $req=$bdd->prepare('SELECT reste_conge FROM employe WHERE matricule=?');
                    $req->execute(array($this->matricule));
                    $donnee=$req->fetch();
                    $reste=$donnee['reste_conge'];
                    $req->closeCursor();
                    $req=$bdd->prepare('UPDATE employe SET reste_conge=?  WHERE matricule=?');
                    $req->execute(array(
                        (($reste*24*3600+$date2-$date1)/(24*3600)),
                        $this->matricule
                    ));
                    $req->closeCursor();
                }
                $req=$bdd->prepare('DELETE FROM conge WHERE id=? ');
                $req->execute(array($id));
            }
            else
            {
                //Suppression pas valide
            }
        }
    }


    public function stop_conge($id)
    {
        $bdd=Utilitaire::connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM conge WHERE id=? ');
        $req->execute(array($id));
        $num_of_rows=$req->rowCount();
        if ($num_of_rows==1)
        {
            $donnee=$req->fetch();

            $this->matricule = $donnee['matricule'];
            $this->type_conge = $donnee['type_conge'];
            $this->date_debut = $donnee['date_debut'];
            $this->date_fin =$donnee['date_fin'];
            $this->demande_conge = $donnee['demande_conge'];

            $req->closeCursor();
            if (strtotime($this->date_fin)>time())// on doit rajouter à l'employé les jours non consomés
            {
                $req=$bdd->prepare('SELECT reste_conge FROM employe WHERE matricule=?');
                $req->execute(array($this->matricule));
                $donnee=$req->fetch();
                $reste=$donnee['reste_conge'];
                $req->closeCursor();
                $req=$bdd->prepare('UPDATE employe SET reste_conge=?  WHERE matricule=?');
                $req->execute(array(
                    ($reste*24*3600+(strtotime($this->date_fin)-time()))/(24*3600),
                    $this->matricule
                ));
                $req->closeCursor();
                $req=$bdd->prepare('UPDATE conge SET date_fin=? WHERE id=? ');
                $date = date('Y-m-d H:i:s');
                $req->execute(array($date,$id));
            }

        }
    }

    public function valid_modif_conge($critere,$champ,$id)
    {
        $bdd=Utilitaire::connexion_bdd();
        if($critere=="date_debut")
        {
            $coupure=0;
            $req=$bdd->prepare('SELECT date_debut,date_fin,matricule FROM conge WHERE id=?' );
            $req->execute(array($id));
            $donnee=$req->fetch();
            $matricule=$donnee['matricule'];
            $date_debut=$donnee['date_debut'];
            $debut=strtotime($champ);
            $fin=strtotime($donnee['date_fin']);
            $actuel=strtotime(date('Y-m-d H:i:s'));
            if (($debut>$actuel)&&($fin>$debut)&&(strtotime($date_debut)>$actuel))
            {
                $req->closeCursor();
                $req=$bdd->prepare('SELECT date_debut,date_fin FROM conge WHERE matricule=? AND id!=?');
                $req->execute(array($matricule,$id));
                while (($donnee2=$req->fetch()))
                {
                    if (($champ>$donnee2['date_debut'])&&($champ<$donnee2['date_fin']))
                    {
                        $coupure=1;
                    }
                }
                if($coupure==0)
                {
                    if (strtotime($date_debut)>$debut)
                    {
                        $req->closeCursor();
                        $req=$bdd->prepare('SELECT reste_conge FROM employe WHERE matricule=?');
                        $req->execute(array($matricule));
                        $donnee2=$req->fetch();
                        if($donnee2['reste_conge']*3600*24>(strtotime($date_debut)-$debut))
                        {
                            return "valide";
                        }
                        else
                        {
                            return "reste";
                        }
                    }
                    else
                    {
                        return "valide";
                    }
                }
                else
                {
                    return "coupure";
                }
            }
            else
            {
                if ($debut<$actuel) return "debut>actuel";
                if ($fin<$debut) return "fin<debut";
            }
        }
        elseif ($critere=="date_fin")
        {
            $coupure=0;
            $req=$bdd->prepare('SELECT date_debut,date_fin,matricule FROM conge WHERE id=?' );
            $req->execute(array($id));
            $donnee=$req->fetch();
            $matricule=$donnee['matricule'];
            $date_fin=strtotime($donnee['date_fin']);
            $fin=strtotime($champ);
            $debut=strtotime($donnee['date_debut']);
            $actuel=strtotime(date('Y-m-d H:i:s'));
            if ($fin>$actuel&&$fin>$debut)
            {
                $req->closeCursor();
                $req=$bdd->prepare('SELECT date_debut,date_fin FROM conge WHERE matricule=? AND id!=?');
                $req->execute(array($matricule,$id));
                while (($donnee2=$req->fetch()))
                {
                    if (($champ>$donnee2['date_debut'])&&($champ<$donnee2['date_fin']))
                    {
                        $coupure=1;
                    }
                }
                if($coupure==0)
                {
                    if ($fin>$date_fin)
                    {
                        $req->closeCursor();
                        $req=$bdd->prepare('SELECT reste_conge FROM employe WHERE matricule=?');
                        $req->execute(array($matricule));
                        $donnee2=$req->fetch();
                        if($donnee2['reste_conge']*3600*24>($fin-$date_fin))
                        {
                            return "valide";
                        }
                        else
                        {
                            return "reste";
                        }
                    }
                    else
                    {
                        return "valide";
                    }
                }
                else
                {
                    return "coupure";
                }

            }
            else
            {
                if ($fin<$actuel) return "fin<actuel";
                if ($fin<$debut) return "fin<debut";
            }

        }
    }

    public function modif_conge($critere,$champ,$id)
    {
        $bdd=Utilitaire::connexion_bdd();

        if($critere=="date_debut")
        {

            $req=$bdd->prepare('SELECT matricule,date_debut FROM conge WHERE id=?');
            $req->execute(array($id));
            $donnee=$req->fetch();
            $matricule=$donnee['matricule'];
            $date_debut=$donnee['date_debut'];
            $req->closeCursor();

            $req=$bdd->prepare('SELECT reste_conge FROM employe WHERE matricule=?');
            $req->execute(array($matricule));
            $donnee2=$req->fetch();
            $reste=$donnee2['reste_conge'];
            $difference=(strtotime($champ)-strtotime($date_debut))/(24*3600);
            $reste=$reste+$difference;
            $req->closeCursor();

            $req=$bdd->prepare('UPDATE employe SET reste_conge=? WHERE matricule=? ');
            $req->execute(array($reste,$matricule));

            $req->closeCursor();
            $req=$bdd->prepare('UPDATE conge SET date_debut=? WHERE id=?' );
            $req->execute(array(
                $champ,
                $id
            ));

        }
        if($critere=="date_fin")
        {
            $req=$bdd->prepare('SELECT matricule,date_fin FROM conge WHERE id=?');
            $req->execute(array($id));
            $donnee=$req->fetch();
            $matricule=$donnee['matricule'];
            $date_fin=$donnee['date_fin'];
            $req->closeCursor();

            $req=$bdd->prepare('SELECT reste_conge FROM employe WHERE matricule=?');
            $req->execute(array($matricule));
            $donnee2=$req->fetch();
            $reste=$donnee2['reste_conge'];
            $difference=(strtotime($date_fin)-strtotime($champ))/(24*3600);
            $reste=$reste+$difference;
            $req->closeCursor();

            $req=$bdd->prepare('UPDATE employe SET reste_conge=? WHERE matricule=? ');
            $req->execute(array($reste,$matricule));

            $req->closeCursor();
            $req=$bdd->prepare('UPDATE conge SET date_fin=? WHERE id=?' );
            $req->execute(array(
                $champ,
                $id
            ));
        }
    }

    public function genererTitreConge()
    {
        $bdd=connexion_bdd();
        $entreprise=new Entreprise();
        $entreprises=$entreprise->get_entreprise();
        $entreprise1=$entreprises->fetch();


        $employe=new Employe();
        $req=$employe->getemploye_matricule($this->matricule);
        $emp=$req->fetch();
        $employe->setemploye($emp['matricule'], $emp['nom'], $emp['prenom'], $emp['statut'], $emp['post'], $emp['assurence'], $emp['date_naissance'],$emp['lieu_naissance'], $emp['date_embauche'], $emp['situation_fam'], $emp['respo'], $emp['salaire'], $emp['projet'], $emp['num_social'], $emp['contrat'], $emp['cv'], $emp['date_demission'], $emp['adresse'], $emp['tel'], $emp['email'], $emp['conge'], $emp['reste_conge'], $emp['coord_bancaire'], $emp['comment']);


        //Open the model
        $zip = new ZipArchive;
        $zip->open("templates/templateTitreConge.zip");
        //Make a copy
        $zip2 = new ZipArchive;
        if (!copy("templates/templateTitreConge.zip", "generated/TitreConge.zip")) {
            echo 'failed to copy';
        }
        else
        {
            //Open the copy
            $fullpath = "generated/TitreConge.zip";
            if ($zip2->open($fullpath) == true) {

                //Open the document.xml file and replace whatever u want :)
                $key_file_name = 'word/document.xml';
                $message = $zip2->getFromName($key_file_name);

                $timestamp = date('Y-m-d');

                $duree=(strtotime($this->date_fin)-strtotime($this->date_debut))/(24*3600);

                $retour=$this->date_fin;

                $retour = (date("Y-m-d", strtotime($retour)+24*3600));

                $message = str_replace("WILAYAE", $entreprise1['wilaya'], $message);
                $message = str_replace("ADRESSE", $entreprise1['wilaya'], $message);
                $message = str_replace("DATEACT", $timestamp, $message);
                $message = str_replace("NOMETPRENOMGERANT", $entreprise1['nom_gerant'], $message);
                $message = str_replace("RAISONSOCIALE",$entreprise1['nom_entreprise'], $message);
                $message = str_replace("RCFISCAL", $entreprise1['RC'], $message);
                $message = str_replace("SPACIALITE", $entreprise1['specialite'], $message);
                $message = str_replace("NOMPRENOMEMPLOYE", $employe->getNom().' '.$employe->getPrenom(), $message);
                $message = str_replace("POSTE", $employe->getPost(), $message);
                $message = str_replace("DATEDEBUT", $this->date_debut, $message);
                $message = str_replace("DATEFIN", $this->date_fin, $message);
                $message = str_replace("DUREE", $duree, $message);
                $message = str_replace("DATERETOUR", $retour, $message);


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
                $new_name = $this->replace_extension("generated/TitreConge.zip", "docx");

                rename("generated/TitreConge.zip", "generated/" . $new_name);

                //Salam 3likom ;)
            }
        }
    }
    function replace_extension($filename, $new_extension)
    {
        $info = pathinfo($filename);
        return $info['filename'] . '.' . $new_extension;
    }

    public static function getNombreConges_prez()
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  conge.id AS id_conge , conge.matricule AS matricule , employe.nom AS nom , employe.prenom AS prenom  , conge.type_conge AS type_conge , conge.date_debut AS date_debut ,conge.date_fin AS date_fin 
                                        FROM `conge`
                                        INNER JOIN `employe`
                                        ON `conge`.`matricule` = `employe`.`matricule`  
                                        WHERE `conge`.`date_debut`< ? AND `conge`.`date_fin`>?            ');
        $reponse->execute(array(date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
        return $reponse->rowCount();
    }

    public static function getCongeParMois($mois,$type)
    {
        $year=date("Y");
        $dateLim1=($year."-".$mois."-01");
        $dateLim2=($year."-".$mois."-31");
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  *
                                        FROM conge
                                        WHERE date_debut > ? AND date_debut < ? AND type_conge=?           ');
        $reponse->execute(array($dateLim1,$dateLim2,$type));
        return $reponse->rowCount();

    }

    public static function getCongeparMoisTotal()
    {
        for ($j=1;$j<4;$j++)
        {
            for ($i=1;$i<13;$i++)
            {
                $conge[$j][$i]=self::getCongeParMois($i,$j);
            }
        }


        return $conge;
    }


}


