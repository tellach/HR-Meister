<?php
function connexion()
{
    $valide=false;
    if(/*(isset($_POST['valider']))AND*/ (isset($_POST['user'])) AND (isset($_POST['password'])))
    {
        $user_name=htmlspecialchars($_POST['user']);
        $compte=new Compte();
        $password=$compte->Crypte(htmlspecialchars($_POST['password']),'1');
        $bdd=connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM compte WHERE ((username=?)) ');
        $req->execute(array($user_name));
        $num_of_rows = $req->rowCount() ;
        $bdd2=connexion_bdd();
        $req2=$bdd2->prepare('SELECT * FROM parametres_entreprise ');
        $req2->execute();
        $req2=$req2->fetch();
        $_SESSION['nom_entreprise']=$req2['nom_entreprise'];
        $_SESSION['logo']=$req2['logo'];

        if($num_of_rows!=0)
        {


                $req = $req->fetch();
            $password=$compte->Decrypte($req['passwd'],'1');
            if(($password)==(htmlspecialchars($_POST['password']))) {
                $_SESSION['id'] = $req['id'];
                $_SESSION['nom'] = $req['nom'];
                $_SESSION['prenom'] = $req['prenom'];
                $_SESSION['email'] = $req['email'];
                if ($req['account_permission'] == 'a') {
                    $_SESSION['account_permission'] = 'A';

                } elseif ($req['account_permission'] == 'g') {
                    $_SESSION['account_permission'] = 'G';

                } elseif ($req['account_permission'] == 'ag') {
                    $_SESSION['account_permission'] = 'AG';

                }
                return $req['id'];
            }
            else {
                return -1;
            }
        }
        else
        {
            return -1;
        }
    }

}

function verif_first_time()
{
  $bdd=connexion_bdd();

  $req=$bdd->prepare('SELECT * FROM parametres_entreprise ');
  $req->execute();
  return $req->rowCount();

}

function deconnexion()
{
    session_destroy();
}

function connexion_bdd()
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

?>