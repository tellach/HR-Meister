<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generate_code()
{
    if (isset($_POST['recup_mail'], $_POST['recup_submit'])) {
        if (!empty($_POST['recup_mail'])) {
            $recup_mail = htmlspecialchars($_POST['recup_mail']);
            if (filter_var($recup_mail, FILTER_VALIDATE_EMAIL)) {
                $compte1 = new Compte;
                $bdd = $compte1->connexion_bdd();
                $mailexist = $bdd->prepare('SELECT * FROM compte WHERE email=?');
                $mailexist->execute(array($recup_mail));
                $mailexist1=$mailexist->fetch();
                $mailexist = $mailexist->rowCount();
                if ($mailexist > 0) {
                    $_SESSION['recup_mail'] = $recup_mail;
                    $recup_code = "";
                    for ($i = 0; $i < 8; $i++) {
                        $recup_code .= mt_rand(0, 9);

                    }
                    $_SESSION['recup_code']=$recup_code;
                    $_SESSION['name']=$mailexist1['username'];
                    $_SESSION['id']=$mailexist1['id'];

                } else {
                    $error = "Cette adresse mail n\'est pas enregistée";
                    return $error;
                }
            } else {
                $error = "Adresse mail invalide";
                return $error;
            }
        } else {
            $error = "Veuillez entrer votre adresse mail";
            return $error;

        }
    }

}

function envoyer_code_par_mail($code,$adresse,$name)
{

//Load composer's autoloader
    require 'PHPMailer/vendor/autoload.php';

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'yahi65032@gmail.com';                 // SMTP username
        $mail->Password = 'amine0551780476';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        $entreprise=new Entreprise();
        $entreprise1=$entreprise->get_entreprise();
        $entreprise2=$entreprise1->fetch();
        //Recipients
        $mail->setFrom('yahi65032@gmail.com',$entreprise2['nom_entreprise']);
        $mail->addAddress($adresse/*'gm_admane@esi.dz'*/,$name/* 'amine admane'*/);     // Add a recipient
        $mail->addAddress($adresse/*'gm_admane@esi.dz'*/);               // Name is optional

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $compte=new Compte();
        $compte1=$compte->getcompte_email($adresse);
        $compte2=$compte1->fetch();

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject ='mot de passe oublie';
        $logo='uploads'.$entreprise2['logo'];
        /*$mail->Body    = 'voici le code de la recuperation du mot de passe veuillez entrer ce code : <b> '.$code.' </b>';*/
        $image='"https://itexperts.co.za/wp-content/uploads/2016/07/ForgotPasswordIcon-300x210.jpg"';
      // $mail->Body   = '<!DOCTYPE html><html><body><div><img src="logoff.png"><br>Bonjour '.$compte2['nom'].' ,<br> <label>voici le code de la recuperation du mot de passe veuillez entrer ce code :</label><b>'.$code.'</b></div></body></html>';
        $mail->Body='
        <body style="background: url(http://www.solidbackgrounds.com/images/2560x1440/2560x1440-dark-midnight-blue-solid-color-background.jpg);">
            <div style="margin-left: 100px; margin-right: 100px; background: white;">
                <div>
                   <hr> 
                    <img style="width: 100px;height: 100px;margin-left: 50px;margin-top: 50px;vertical-align: middle;margin-bottom: 5em;border-radius: 50%;" src="https://i.imgur.com/LeYnBmF.jpg" alt="" />
                    <span  style="font-size: 40px;margin-left: 20px;">GRH Manager</span>
                </div>
                 
                <div style="border-top: 1px solid #000;width : 700px;margin-left: 50px;">
                    <p style="color: black;">
                        <br>
                        <br>
                Bonjour '.$compte2['nom'].',<br>
                        <br>
                Nous avons recu une demande de réinitialisation de votre mot de passe .<br>
                        <br>
                Vous pouvez également saisir le code de réinitialisation du mot de passe : <br>
                        <br>
                <b>'.$code.'</b><br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </p>
                </div>
                
            </div>
        
        </body>
        </html>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

function insertion_dans_bdd($mail,$code)
{
    $bdd=connexion_bdd2();
    $req=$bdd->prepare('SELECT * FROM recuperation WHERE (email=?)  ');
    $req->execute(array($mail));
    $num_of_rows = $req->rowCount() ;
    if ($num_of_rows==1)
    {
        $req2=$bdd->prepare('UPDATE recuperation SET code=:code');
        $req2->execute(array(
           'code'=>$code,
        ));
    }
    else
    {
        $req2=$bdd->prepare('INSERT INTO recuperation (email,code) VALUES (:email,:code)');
        $req2->execute(array(
            'email'=>$mail,
            'code'=>$code,
        ));
    }

}
function recuperation_dans_bdd($mail)
{
    $bdd=connexion_bdd2();
    $req=$bdd->prepare('SELECT * FROM recuperation WHERE (email=?) ORDER BY email DESC');
    $req->execute(array($mail));
    $num_of_rows = $req->rowCount() ;
    if ($num_of_rows==1)
    {
        $req3=$req->fetch();
        return $req3;
    }
    else
    {
        return false;
    }
}


 function connexion_bdd2()
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