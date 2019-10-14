<?php

class Compte
{
    private $nom;
    private $prenom;
    private $email;
	private $username;
	private $passwd;
	private $account_permission;
	private $valider_mot_de_passe;
	private $theme;


	public function set_compte($username,$passwd,$account_permission,$valider_mot_de_passe,$nom,$prenom,$email)
	{
		$this->username=$username;
		$this->passwd=$passwd;
		$this->account_permission=$account_permission;
		$this->valider_mot_de_passe=$valider_mot_de_passe;
		$this->theme=1;
		$this->nom=$nom;
		$this->prenom=$prenom;
		$this->email=$email;

	}
	public function valider_mot_de_passe()
	{
		if ($this->passwd==$this->valider_mot_de_passe)
		{
		    return 1;
		}
			else {return 0;}
	}
	public function insert_db_compte()
	{
		$bdd=$this->connexion_bdd();
		$req1=$bdd->prepare('SELECT * FROM compte WHERE (username=?)');
        $req1->execute(array($this->username));
        $num_of_rows = $req1->rowCount() ;

        if($num_of_rows==0)
        {
            $req1->closeCursor();
            $req1=$bdd->prepare('SELECT * FROM compte WHERE (email=?)');
            $req1->execute(array($this->email));
            $num_of_rows = $req1->rowCount() ;

            if($num_of_rows==0)
            {
                $req=$bdd->prepare('INSERT INTO compte (nom,prenom,email,username,passwd,account_permission,theme) VALUES (:nom,:prenom,:email,:username,:passwd,:account_permission,:theme)');
                $req->execute(array(
                'nom' => ($this->nom),
                'prenom' => ($this->prenom),
                'email' => ($this->email),
                'username' => ($this->username),
                'passwd' => $this->Crypte($this->passwd,'1'),
                'account_permission'=>($this->account_permission),
                'theme'=>($this->theme)));
                return 1;
            }
            else
            {
                return -1;
            }
        }
        else
        {
            return 0;
        }

	}

    public function update_db_compte($id)
    {
        $bdd=$this->connexion_bdd();
        $req1=$bdd->prepare('SELECT * FROM compte WHERE (id=?)');
        $req1->execute(array($id));
        $num_of_rows = $req1->rowCount() ;

        if($num_of_rows==1)
        {
            $req1->closeCursor();
            $req1=$bdd->prepare('SELECT * FROM compte WHERE (email=? AND id!=?)');
            $req1->execute(array($this->email,$id));
            $num_of_rows = $req1->rowCount() ;

            if($num_of_rows==0)
            {
                $req1->closeCursor();
                $req1=$bdd->prepare('SELECT * FROM compte WHERE (username=? AND id!=?)');
                $req1->execute(array($this->username,$id));
                $num_of_rows = $req1->rowCount() ;

                if($num_of_rows==0)
                {
                    $req=$bdd->prepare('UPDATE compte SET nom=:nom,prenom=:prenom,email=:email,username=:username,passwd=:passwd,account_permission=:account_permission,theme=:theme WHERE id='.$id);
                    $req->execute(array(
                        'nom' => ($this->nom),
                        'prenom' => ($this->prenom),
                        'email' => ($this->email),
                        'username' => ($this->username),
                        'passwd' => $this->Crypte($this->passwd,'1'),
                        'account_permission'=>($this->account_permission),
                        'theme'=>($this->theme)
                        /*'id'=>$id*/));
                    return 1;
                }
                else
                {
                    return -1;
                }
            }
            else
            {
                return -2;
            }
        }
        else
        {
            return 0;
        }

    }

	public function get_comptes()
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT id,nom,prenom,email,username,account_permission,theme FROM compte');
        $req->execute();

        return $req;

    }
    public function getcompte_email($email)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM compte WHERE (email=?)');
        $req->execute(array($email));
        return $req;

    }
    public function get_compte($id)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM compte WHERE (id=?)');
        $req->execute(array($id));

        return $req;

    }

    public function supprimer($id)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('DELETE FROM compte WHERE (id=?)' );
        $req->execute(array($id));
    }

    public function modification($critere,$id,$champ)
    {
        $bdd=$this->connexion_bdd();
        if ($critere=="username")
        {

            $req=$bdd->prepare('UPDATE compte SET username=:username WHERE id=:id' );
            $req->execute(array(
                'username'=>($champ),
                'id'=>($id)));
        }
        else
        {
            if($critere=="passwd")
            {
                $req=$bdd->prepare('UPDATE compte SET passwd=:passwd WHERE id=:id' );
                $req->execute(array(
                    'passwd'=>$this->Crypte($champ,'1'),
                    'id'=>($id)));
            }
            else
            {
                if($critere=="account_permission")
                {
                    $req=$bdd->prepare('UPDATE compte SET account_permission=:account_permission WHERE id=:id' );
                    $req->execute(array(
                        'account_permission'=>($champ),
                        'id'=>($id)));
                }
                else
                {
                    if($critere=="theme")
                    {

                        $req=$bdd->prepare('UPDATE compte SET theme=:theme WHERE id=:id' );
                        $req->execute(array(
                            'theme'=>($champ),
                            'id'=>($id)));

                    }
                    else
                    {
                        if ($critere=="email")
                        {
                            $req=$bdd->prepare('UPDATE compte SET email=:email WHERE id=:id' );
                            $req->execute(array(
                                'email'=>($champ),
                                'id'=>($id)));

                        }
                    }
                }
            }
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

    public function GenerationCle($Texte,$CleDEncryptage)
    {
        $CleDEncryptage = md5($CleDEncryptage);
        $Compteur=0;
        $VariableTemp = "";
        for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
        {
            if ($Compteur==strlen($CleDEncryptage))
                $Compteur=0;
            $VariableTemp.= substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1);
            $Compteur++;
        }
        return $VariableTemp;
    }

    public function Crypte($Texte,$Cle)
    {
        srand((double)microtime()*1000000);
        $CleDEncryptage = md5(rand(0,32000) );
        $Compteur=0;
        $VariableTemp = "";
        for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
        {
            if ($Compteur==strlen($CleDEncryptage))
                $Compteur=0;
            $VariableTemp.= substr($CleDEncryptage,$Compteur,1).(substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1) );
            $Compteur++;
        }
        return base64_encode($this->GenerationCle($VariableTemp,$Cle) );
    }

    public function Decrypte($Texte,$Cle)
    {
        $Texte = $this->GenerationCle(base64_decode($Texte),$Cle);
        $VariableTemp = "";
        for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
        {
            $md5 = substr($Texte,$Ctr,1);
            $Ctr++;
            $VariableTemp.= (substr($Texte,$Ctr,1) ^ $md5);
        }
        return $VariableTemp;
    }
}

?>