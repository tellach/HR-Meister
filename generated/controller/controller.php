<?php

require_once('model/Conge.php');
require('model/m_connexion.php');
require('model/class_compte.php');
require('model/class_employe.php');
require('model/mot_de_passe_oublier.php');
require('model/Entreprise.php');
require('model/class_candidat.php');
require('model/Objectif.php');
require('model/Entretien_devaluation.php');
require('model/class_embauche.php');


function ajoutConge()
{
    $conge = new Conge();
    $valid = $conge->setConge_from_post();
    if ($valid == 1) {
        $retour = $conge->validation_conge();
        if ($retour == "valide") {
            $conge->ajout_conge();
            if ($conge->getTypeConge() == 1) {
                $conge->soustraction_reste_conge();
            }
            header('Location:index.php?action=list_conge_venir');
        } else {
            affich_ajoutConge($retour);
        }
    } else {
        affich_ajoutConge("form");
    }

}

function affich_ajoutConge($retour)
{
    require('view/ajout_conge.php');
}

function listConges_pass()
{
    $conges = Conge::getConges_pass();
    require('view/conges_pass.php');

}

function listConges_prez()
{
    $conges = Conge::getConges_prez();
    require('view/conges_prez.php');

}

function listConges_venir()
{
    $conges = Conge::getConges_venir();
    require('view/conges_venir.php');

}

function listConges_employe($matricule)
{
    $employe=new Employe();
    $emp=$employe->getemploye_matricule($matricule);
    $conges= Conge::getConge_matricule($matricule);
    require('view/conges_employe.php');
}

function listCongeGlobal()
{
    $conges = Conge::getConges();
    require ('view/gantt.php');
}
function supprimerConge($id)
{
    $conge = new Conge();
    $conge->supp_conge($id);
    header('Location:index.php?action=list_conge_venir');

}

function arreterConge($id)
{
    $conge = new Conge();
    $conge->stop_conge($id);
    header('Location:index.php?action=list_conge_prez');

}

function modifierConge($id)
{
    $conge = new Conge();
    $retour = $conge->valid_modif_conge($_GET['critere'], $_POST['date'], $id);
    if ($retour == "valide") {
        $conge->modif_conge($_GET['critere'], $_POST['date'], $id);
        if ($_GET['modif'] == "futur") listConges_venir();
        if ($_GET['modif'] == "prez") listConges_prez();
    } else {
        if ($_GET['modif'] == "futur") affich_modifierConge_venir($id, $retour,$_GET['critere']);
        if ($_GET['modif'] == "prez") affich_modifierConge_prez($id, $retour);
    }

}

function affich_modifierConge_prez($id, $retour)
{
    $conge = new Conge();
    $congeId = $conge->getConge($id);
    require('view/modifConge_prez.php');
}

function affich_modifierConge_venir($id, $retour,$critere)
{

    $conge = new Conge();
    $congeId = $conge->getConge($id);
    require('view/modifConge_venir.php');

}

function c_deconnexion()
{
    deconnexion();
}

function c_connexion()
{
    session_start();
    $val = connexion();
    if ($val > 0) {
        $_SESSION['connect'] = 1;
        if (verif_first_time() == 0) {
        } else {
            header("Location:index.php");//Accueil

        }

    } elseif ($val == -1) {
        $erreur = 1;
        require("view/connexion.php");
    } else {
        require("view/connexion.php");
    }

}

function acces_refuse()
{
    require ("view/access_control.php");
}

function verif_connexion()
{
    session_start();
    if (isset($_SESSION['connect']))//On vérifie que le variable existe.
    {
        $connect = $_SESSION['connect'];//On récupère la valeur de la variable de session.
    } else {
        $connect = 0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
    }
    if ($connect == 0) // Si le visiteur s'est identifié.
    {
        session_destroy();
    }
    return $connect;
}

function accueil()
{
    $nombreEmploye = Employe::totalEmploye();
    $moyenneSalaire = Employe::moyenneSalaire();
    $nombreCandidat = candidat::totalCandidat();
    $employeActif = (Conge::getNombreConges_prez() * 100) / $nombreEmploye;
    $conge=Conge::getCongeparMoisTotal();
    $entretien=Entretien_devaluation::getEntretienparMoisTotal();
    $embauche=Embauche::getEmbaucheParMoisTotal();
    $ages=Employe::getAges();
    $entretiens_today=Entretien_devaluation::getEntretienAujourdhui();
    $embauches_today=Embauche::getEmbaucheAujourdhui();
    require('view/accueil.php');
}

function affich_ajoutCompte($erreur)
{
    require('view/ajoutCompte.php');
}

function affich_ajoutEmploye($errors)
{if (isset($_GET['a'])){$a=($_GET['a']);
    if ($a==5){
    $candidat=new candidat();
$donna=$candidat->getcandidat_id($_GET['id']);}}
    require('view/ajouter_employe.php');
}

function ajouter_admin_gestionnaire()
{


    $compte = new Compte;
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['account_permission']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])) {
        $compte->set_compte($_POST['username'], $_POST['password'], $_POST['account_permission'], $_POST['valider_mot_de_passe'], $_POST['nom'], $_POST['prenom'], $_POST['email']);
        if (($compte->valider_mot_de_passe()) == 1) {
            $ok = $compte->insert_db_compte();
            if ($ok == 1) {
                header("Location:index.php?action=affichage_comptes");
            } elseif ($ok == 0) {
                affich_ajoutCompte("username");
            } else {
                affich_ajoutCompte("email");
            }
        } else {
            affich_ajoutCompte("password");
        }

    } else {
        affich_ajoutCompte("form");
    }
}

function affichage_comptes()
{
    $compte = new Compte();
    $comptes = $compte->get_comptes();

    require('view/affichage_comptes.php');
}

function ajouter_employe()
{
    $employe = new Employe;
    $x = $employe->setemploye2();
    $errors = $employe->validationAjout();
    if ($x == -1) {
        $errors['exists'] = 1;
        $errors['file'] = 1;
    }
    if ($errors['exists'] == 0) {

      // $employe->affiche();
        $r=$employe->insert_db_employe();
        //echo ($r);
        affichage_employes();
    } else {


        affich_ajoutEmploye($errors);
    }

}

function supprimer_compte()
{
    $compte2 = new Compte;
    if (isset($_GET['id'])) {
        $compte2->supprimer($_GET['id']);
    }
    //header("Location: view/affichage_comptes.php");
    affichage_comptes();
}

function modifier_compte($id)
{
    /*
        if (1) {

            if ($_GET['critere'] == "passwd") {
                $compte1 = new Compte();
                $comptes1 = $compte1->get_compte($id);
                $compte2 = $comptes1->fetch();
                if (($_POST['ancient_passwd'] == $compte2['passwd']) && ($_POST['valider_mot_de_passe'] == $_POST['champ'])) {
                    $compte1->modification($_GET['critere'], $id, $_POST['champ']);
                    $variables = ["id" => $id];
                    affich_compte_modification($variables);

                } else {
                    $variables = [
                        "id" => $id,
                        "errors" => [

                                "div" => 'div1',
                                "msgs" => [
                                    "Erreur 1",
                                    "Erreur 2",
                                    "Erreur 3"
                                ]

                        ]
                    ];
                    affich_compte_modification($id);
                }

            } else {
                $compte1 = new Compte();
                $compte1->modification($_GET['critere'], $id, $_POST['champ']);
                affich_compte_modification($id);
            }

        }

        //header("Location:index.php?id='.$id.'&amp;action=affiche_compte_modifier");
    */
    $compte = new Compte;
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['account_permission']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])) {
        $compte->set_compte($_POST['username'], $_POST['password'], $_POST['account_permission'], $_POST['valider_mot_de_passe'], $_POST['nom'], $_POST['prenom'], $_POST['email']);
        if (($compte->valider_mot_de_passe()) == 1) {
            $ok = $compte->update_db_compte($id);
            if ($ok == 1) {
                affichage_comptes();
            } elseif ($ok == 0) {
                affich_compte_modification($id, "id");
            } elseif ($ok == -1) {
                affich_compte_modification($id, "username");
            } elseif ($ok == -2) {
                affich_compte_modification($id, "email");
            }
        } else {
            affich_compte_modification($id, "password");
        }

    } else {
        affich_compte_modification($id, "form");
    }

}

function affich_compte_modification($id, $erreur) //$variable
{
    //extract($variables, EXTR_PREFIX_SAME, "wddx");
    $compte = new Compte();
    $comptes = $compte->get_compte($id);

    require('view/modification_admin_compte.php');
}

function affichage_employes()
{
    $employe = new Employe();
    $employes = $employe->getemploye();
    require('view/affichage_employes.php');
}

function affiche_salaire_historique($id)
{
    $employe = new Employe();
    $employes = $employe->getemploye_id($id);
    $employes1 = $employes->fetch();
    $salaire = $employe->getemploye_historique($employes1['matricule']);
    require('view/historique_salaire.php');
}

function affichage_employe_modification($id,$errors)
{
    $employe = new Employe();
    $employes = $employe->getemploye_id($id);

    require('view/modification_employe.php');
}

function modification_employe($id)
{
    $employe = new Employe();
    $critere = $employe->setemploye2();
    $errors=$employe->validationModif($id);
    //$employe->affiche();
    if ($errors['exists']==0)
    {
        $employe->modification($id, $critere);
        affichage_employes();
    }
    else
    {
        affichage_employe_modification($id,$errors);
    }

}

function affichage_employe_modification2($id)
{
    $employe = new Employe();
    $employes = $employe->getemploye_id($id);

    require('view/info_employe.php');
}

function desactiveEmploye($id)
{
    $employe=new Employe ();
    $employe->desactiveEmploye($id);
    affichage_employes();
}

function reactiveEmploye($id)
{
    $employe=new Employe ();
    $employe->reactiveEmploye($id);
    affichage_employes();
}

function contrat_input($id,$error)
{
    require ('view/contrat_input.php');
}
function contrat_modif($id)
{
    $emp=new Employe();
    $error=$emp->contrat_modif($id);
    if ($error='success') affichage_employe_modification2($id);
    else contrat_input($id,$error);
}

function affichage_parametre_entrprise()
{
    $entreprise = new Entreprise();
    $entreprises = $entreprise->get_entreprise();
    $entreprises2 = $entreprises;
    require('view/param.php');
    //require('view/parametre_entreprise.php');

}

function affichage_parametre_entrprise2($error)
{
    $entreprise = new Entreprise();
    $entreprises = $entreprise->get_entreprise();
    $entreprises2 = $entreprises;
    //require('view/param.php');
    require('view/parametre_entreprise.php');

}

function modification_parametres_entreprise()
{

    $entreprise = new Entreprise();
    $critere = $entreprise->set_entreprise();
    //$entreprise->affichage();
    if ($critere!='extension')
    {
        $entreprise->modification_entreprise2($critere);
        affichage_parametre_entrprise();
    }
    else
    {
        affichage_parametre_entrprise2('extension');
    }


}

function listcandidat()
{
    $candidat = new candidat();
    $candidats = $candidat->getCandidat();
    require('view/candidats.php');

}

function ajouter_candidat()
{
    $candidat = new candidat;
    $dal = $candidat->set_candidat();
    //$candidat->affiche();
    //if ($dal=="avec_fichier"){
    $err=$candidat->insert_db_candidat();
    if($err==0){
    listcandidat();}else{
        affich_ajoutcandidat('date');
    }
    //header("Location:index.php?action=list_candidat");
    //$candidat->affiche();


}

function affich_ajoutcandidat($error)
{
    require('view/ajouter_candidat.php');
}

function affichage_candidat_modification($id,$error)
{
    $candidat = new Candidat();
    $candidats = $candidat->getcandidat_id($id);

    require('view/modifier_candidat.php');
}

function modification_candidat($id)
{
    $candidat = new Candidat();
    $candidat->setcandidat($_POST['nom'], $_POST['prenom'], $_POST['post'], $_POST['date_naissance'], $_POST['salaire'], $_POST['tel'], $_POST['email'], $_POST['comment'],$_POST['etat']);
    //$critere=$candidat->set_candidat();
    // $candidat->affiche();
    $err=$candidat->modification_candidat2($id);

    if($err==0){


        listcandidat();}
        else{affichage_candidat_modification($id,'date');

    }
}





function affichage_candidat_modification2($id)
{
    $candidat = new Candidat();
    $candidats = $candidat->getcandidat_id($id);

    require('view/info_candidat.php');
}

function generateAttestation($id)
{
    $employe = new Employe();
    $req = $employe->getemploye_id($id);
    $emp = $req->fetch();
    $employe->setemploye($emp['matricule'], $emp['nom'], $emp['prenom'], $emp['statut'], $emp['post'], $emp['assurence'], $emp['date_naissance'], $emp['lieu_naissance'], $emp['date_embauche'], $emp['situation_fam'], $emp['respo'], $emp['salaire'], $emp['projet'], $emp['num_social'], $emp['contrat'], $emp['cv'], $emp['date_demission'], $emp['adresse'], $emp['tel'], $emp['email'], $emp['conge'], $emp['reste_conge'], $emp['coord_bancaire'], $emp['comment']);
    $employe->genererAttestation();
    telechargerFichier("Attestation");
}

function generateCertificat($id)
{
    $employe = new Employe();
    $req = $employe->getemploye_id($id);
    $emp = $req->fetch();
    $employe->setemploye($emp['matricule'], $emp['nom'], $emp['prenom'], $emp['statut'], $emp['post'], $emp['assurence'], $emp['date_naissance'], $emp['lieu_naissance'], $emp['date_embauche'], $emp['situation_fam'], $emp['respo'], $emp['salaire'], $emp['projet'], $emp['num_social'], $emp['contrat'], $emp['cv'], $emp['date_demission'], $emp['adresse'], $emp['tel'], $emp['email'], $emp['conge'], $emp['reste_conge'], $emp['coord_bancaire'], $emp['comment']);
    $employe->genererCertificat();
    telechargerFichier("Certificat");

}

function generateContrat($id)
{
    $employe = new Employe();
    $req = $employe->getemploye_id($id);
    $emp = $req->fetch();
    $employe->setemploye($emp['matricule'], $emp['nom'], $emp['prenom'], $emp['statut'], $emp['post'], $emp['assurence'], $emp['date_naissance'], $emp['lieu_naissance'], $emp['date_embauche'], $emp['situation_fam'], $emp['respo'], $emp['salaire'], $emp['projet'], $emp['num_social'], $emp['contrat'], $emp['cv'], $emp['date_demission'], $emp['adresse'], $emp['tel'], $emp['email'], $emp['conge'], $emp['reste_conge'], $emp['coord_bancaire'], $emp['comment']);
    $employe->genererContrat();
    telechargerFichier("Contrat");

}

function generateTitreConge($id)
{
    $conge = new Conge();
    $req = $conge->getConge($id);
    $con = $req->fetch();
    $conge->setConge($con['matricule'], $con['type_conge'], $con['date_debut'], $con['date_fin'], $con['demande_conge']);
    $conge->genererTitreConge();
    telechargerFichier("Conge");

}

function telechargerFichier($nom_fichier)
{
    if ($nom_fichier == "Attestation") {
        require('view/telechargerAttestation.php');
    }
    if ($nom_fichier == "Certificat") {
        require('view/telechargerCertificat.php');
    }
    if ($nom_fichier == "Contrat") {
        require('view/telechargerContrat.php');
    }
    if ($nom_fichier == "Conge") {
        require('view/telechargerConge.php');
    }

}

function affichage_des_objectif($matricule)
{
    $objectif=new Objectif();
    $req=$objectif->get_objectifs($matricule);
    require('view/affichage_objectifs.php');
}

function ajouter_objectif($matricule)
{
    $objectif=new Objectif();
    $objectif->Set_objectif($matricule);
    if($objectif->insert_into_db()!='error')
    {
        affichage_des_objectif($matricule);
    }
    else
    {
        affiche_page_ajouter_objectif('error');
    }
}

function affiche_page_ajouter_objectif($error)
{
    require ("view/ajouter_objectif.php");
}

function supprimer_objectif($id,$matricule)
{
    $objectif= new Objectif();
    $objectif->supprimer($id);
    affichage_des_objectif($matricule);
}

function affichage_objectif_critere($matricule)
{
    $objectif1=new Objectif();
    $req1=$objectif1->get_objectifs($matricule);
    $req2=$objectif1->get_objectifs($matricule);
    $req3=$objectif1->get_objectifs($matricule);
    require('view/ajouter_entretien.php');
}

function affichage_objectif_critere2($matricule,$erreur)
{
    $objectif1=new Objectif();
    $req1=$objectif1->get_objectifs($matricule);
    $req2=$objectif1->get_objectifs($matricule);
    $req3=$objectif1->get_objectifs($matricule);
    $employe=new Employe();
    $employes=$employe->getemploye_matricule($matricule);
    $employe=$employes->fetch();
    $id_employe=$employe['id'];
    require('view/afficher_entretien.php');
}

function affichage_modif_objectif($id,$matricule,$error)
{
    $objectif=new Objectif();
    $req=$objectif->get_objectif($id);

    require ('view/modification_objectif.php');
}

function modification_objectif($id,$matricule)
{
    $objectif=new Objectif();
    $objectif->Set_objectif2();
    if($objectif->modifier_objectif($id)!='error')
    {
        affichage_des_objectif($matricule);
    }
    else
    {
        affichage_modif_objectif($id,$matricule,'error');
    }
}

function telecharger_entretien($matricule)
{
    $entretien=new Entretien_devaluation();
    $x=$entretien->set_entretien($matricule);
    if($x=='') {
        $entretien_name='generated/entretien'.date("Y-m-d").$matricule.'.xlsx';
        $entretien->insertion_entretient_das_bdd($matricule);
        $entretien->modifier_entete($matricule);
        $entretien->modifier_tableaux($matricule);
        $entretien->supprimer_fichier('aa1.xlsx');
        $entretien->modifier_les_ojectif_court_terme($matricule);
        $entretien->supprimer_fichier('aa2.xlsx');
        $entretien->modifier_les_ojectif_moyen_terme($matricule);
        $entretien->supprimer_fichier('aa3.xlsx');
        $entretien->modifier_les_ojectif_long_terme($matricule);
        $entretien->supprimer_fichier('aa4.xlsx');
        $employe=new Employe();
        $employes=$employe->getemploye_matricule($matricule);
        $employe=$employes->fetch();
        $id_employe=$employe['id'];
        require('view/validation_entretien.php');
    }
    else
    {
        affichage_objectif_critere2($matricule,$x);
    }
}

function affichage_entretiens($matricule)
{
    $entretien=new Entretien_devaluation();
    $entretien1=$entretien->tout_les_entretiens($matricule);
    $employe=new Employe();
    $employes=$employe->getemploye_matricule($matricule);
    $employe=$employes->fetch();
    $id_employe=$employe['id'];
    require ('view/affichage_entretiens.php');
}


function telecharger_annuaire()
{

    $annuaire=new Entretien_devaluation();
    $annuaire->modifier_excel_annuaire();
    require ('view/telecharger_annuaire.php');

}

function telecharger_historique($matricule)
{

    $employe9=new Employe();
    $empl=$employe9->getemploye_matricule($matricule);
    $empl1=$empl->fetch();
    $annuaire=new Entretien_devaluation();
    $annuaire->modifier_excel_historique_des_salaire($matricule);
    require ('view/telecharger_historique.php');

}
////////////////////////embauche//////////////////

function list_embauche($k/*,$id*/)
{   if ($k==1){ listembauchepass();


}elseif ($k==2){listembauchetoday();

}elseif ($k==3){listembauchefutur();}
elseif ($k==5){listcandidat();

}//elseif ($k==0){affichage_candidat_modification2($id);};
}

function  liste_entretiens_candidat($b)
{   $embauche = new embauche();
    $embauches = embauche:: getembauchecandidat($b);
    //echo $embauches;
    require('view/calendrier.php');
}

function listembauchetoday()
{   $embauche = new embauche();
    $embauches = embauche:: getembauchetoday();
    //echo $embauches;
    require('view/entretien_today.php');
}

function listembauchepass()
{   $embauche = new embauche();
    $embauches = embauche:: getembauchepass();
    //echo $embauches;
    require('view/entretien_passes.php');
}

function listembauchefutur()
{   $embauche = new embauche();
    $embauches = embauche:: getembauchefutur();
    //echo $embauches;
    require('view/entretien_venir.php');
}

function ajouter_embauche($where)
{
    $candidat = new candidat();
    $embauche = new embauche();
    $id =$_GET['id'];
    $valid = $embauche->set_embauche();
    $err=$candidat->candidatexist($embauche->getMatricule());
    if ($valid == 1)
    {     if($err==1){

    if ($embauche->validation_embauche() == 1) {
            $embauche->insert_db_embauche();
            //echo 'dakheel';

            //echo('L\' entretien a été bien ajouté');
        }
        else
        {
            affich_ajoutembauche($where,'date');
        }
    }else{
        affich_ajoutembauche($where,'mat');

    }
    }
    else
    {
        affich_ajoutembauche($where,'form');
        //echo 'Le formulaire n\'a pas était bien rempli';
    }
    list_embauche($where);
}

function affichage_embauche_modification2($id,$where)
{
    $embauche=new embauche();
    $embauches=$embauche->getembauche_id2($id);
   // echo $id;echo'   '; echo $where;

    $questions=embauche::getquestions($id);
    // $embauche=$embauches->fetch();
    //echo 'jjeeeeeesuiiiiis la';echo $embauches['nom'];
    require ('view/info_embauche.php');
}

function affichage_embauche_modification($id,$where,$error)
{
    $embauche=new embauche();
    $embauches=$embauche->getembauche_id($id);

    require ('view/modifier_embauche.php');
}

function affichage_commencer_embauche($id,$where,$error)
{
    $embauche=new embauche();
    $embauches=$embauche->getembauche_id($id);

    require ('view/commencer_embauche.php');
}

function commencer($id,$where)
{
    $embauche=new embauche();
    $embauches=$embauche->getembauche_id($id);
    $don=$embauches->fetch();
    $embauche->setembauche($don['datee'],$don['matricule'],$don['note'],$don['poste'],$don['salaire']);
    //$embauche->affiche();
    $embauche->report_embauche($id,date('Y-m-d'));
    $embauches=$embauche->getembauche_id($id);
    affichage_commencer_embauche($id,$where,'');
   // require ('view/modifier_embauche.php');
}

function suite_embauche($id,$where)
{
    $embauche = new embauche();

    $embauche->setembauche($_POST['datee'],$_POST['matricule'],$_POST['note'], $_POST['poste'], $_POST['salaire']);

    $err=$embauche->modification_embauche2($id);
    if ($err!=0){ affich_ajoutquestion($id,$id,$where);}
    else{  affichage_commencer_embauche($id,$where,'date');}



    //listembauchetoday();
}


function modification_embauche($id)
{
    $embauche = new embauche();
    $where=3;
    $embauche->setembauche($_POST['datee'],$_POST['matricule'],$_POST['note'], $_POST['poste'], $_POST['salaire']);
    //$embauche->affiche(); echo $id;
    $err=$embauche->modification_embauche2($id);
    if ($err!=0){affichage_embauche_modification2($id,$where);}
    else{affichage_embauche_modification($id,$where,'date');}
}

function affich_ajoutembauche($where,$error){
    if (isset($_GET['id'])){
        $id =$_GET['id'];

    }
require ('view/ajouter_entretien_calendrier.php');
}

function supprimerembauche($id,$where)
{
    $embauche = new embauche();
    // echo 'llllllllllllllllllll';
    //$embauche->affiche();
    $embauche->supp_embauche($id);
    list_embauche($where);

}

function reportembauche($id,$where)
{
    $embauche = new embauche();
    $embauches=$embauche->getembauche_id($id);
    $don=$embauches->fetch();
    $embauche->setembauche($don['datee'],$don['matricule'],$don['note'],$don['poste'],$don['salaire']);

    $err=$embauche->report_embauche($id,$_POST['datee']);
  if (  $err!=0){
      list_embauche($where);

}else{ reportembauche1($id,$where,'date');

  }


}

function reportembauche1($id,$where,$error)
{
    //echo $id;
    $embauche=new embauche();
    $embauches=$embauche->getembauche_id($id);
    $don=$embauches->fetch();
    $embauche->setembauche($don['datee'],$don['matricule'],$don['note'],$don['poste'],$don['salaire']);
    //$embauche->affiche();
    require ('view/modifier_date.php');

}

//////////////////questions//////////////////
function affichage_question_modification($id,$emb,$where)
{
    $embauche=new embauche();
    $questions=$embauche->getquestion_id($id);

    require ('view/modifier_question.php');

}

function supprimerquestion($id,$emb,$where)
{
    $embauche = new embauche();
    $embauche->supp_question($id);


    //

    affichage_embauche_modification2($emb,$where);


}

function modification_question($id,$emb,$where)
{
    $embauche = new embauche();
    $embauche->modification_question2($id,$_POST['question'],$_POST['reponse']);
    affichage_embauche_modification2($emb,$where);
}

function affich_ajoutquestion($idd,$emb,$where){
    //echo $idd;
    require ('view/ajouter_question.php');
}

function ajouter_question($emb,$where)

{ //echo $_POST['id'];
    $embauche = new embauche();

    $valid = $embauche->set_question();

    $embauche->insert_db_question();
     affich_ajoutquestion($_POST['id'],$emb,$where);
    //echo('L\' question a été bien ajouté');
}

function affichaccepter($idd,$emb,$where){
    //echo $idd;
    require ('view/affichaccepter.php');
}

function accepter($emb,$where)

{    $embauche = new embauche();
    $candidat = new candidat();
    $candidats = $candidat->getcandidat_id($_POST['id']);
    $candidat->setEtat($_POST['etat']);
    $candidat->modification_candidat($_POST['id']);
    //echo('L\' accept');
    list_embauche($where);
}


function affich_ajoutquestion1($idd,$emb,$where){
    //echo $idd;
    require ('view/ajouter_question1.php');
}

function ajouter_question1($emb,$where)

{ //echo $_POST['id'];
    $embauche = new embauche();

    $valid = $embauche->set_question();

    $embauche->insert_db_question();
    affichage_embauche_modification2($emb,$where);

    // affich_ajoutquestion($_POST['id']);
    //echo('L\' question a été bien ajouté');
}

function envoie_du_mail_de_recup()
{
    ob_start();
    session_start();
    $error=generate_code();
    if(!empty($error))
    {
        require ("view/recuperation_password.php");
    }
    if (isset($_SESSION['recup_mail'],$_SESSION['recup_code'],$_SESSION['name'])) {

        $send=envoyer_code_par_mail($_SESSION['recup_code'], $_SESSION['recup_mail'], $_SESSION['name']);
        if ($send==true) {

            $recup_code=$_SESSION['recup_code'];
            $recup_mail=$_SESSION['recup_mail'];
            insertion_dans_bdd($recup_mail,$recup_code);

            header("Location:index.php?action=reinitialisation_password_affiche");
            ob_end_flush();



            }
    }



}

function reinitialisation_password()
{


    if (isset($_POST['email_recup'], $_POST['code'], $_POST['submit_val']))
    {

        if (!empty($_POST['email_recup']))
        {


            if (!empty($_POST['code'])) {
                $req=recuperation_dans_bdd($_POST['email_recup']);

                if ($req!=false) {
                    if ($_POST['code'] == $req['code']) {
                        $compte=new Compte();
                        $comptes1=$compte->getcompte_email($req['email']);
                        $comptes=$comptes1->fetch();
                        header('Location:index.php?action=new_password_affche&id='.$comptes['id']);

                    } else
                    {

                        $error = "code incorrect";

                    }

                }
                else
                {
                    $error = "adresse mail invalide";
                }

            }
            else {
                $error = "Veuillez entrer le code";
            }
        }
        else {
            $error = "Veuillez entrer votre adresse mail";
        }

    }
    if(!empty($error))
    {
        require ("view/recup_password_lien_mail.php");
    }


}

function new_password()
{
    if (isset($_POST['password'],$_POST['val_password'],$_POST['valider']))
    {
        if(!empty($_POST['password']))
        {
            if (!empty($_POST['val_password']))
            {
                if ($_POST['password']==$_POST['val_password']) {
                    $compte = new Compte;
                    $compte->modification("passwd", $_GET['id'], $_POST['password']);
                    header('Location:index.php?action=accueil');
                }
                else
                {
                    $error="validation incorrect";
                }

            }
            else
            {
                $error="veuillez entrer la validation ";
            }

        }
        else
        {
            $error="veuillez enter le nouveu mot de passe";
        }
    }

    if(!empty($error))
    {
        require ("view/new_password.php");
    }
}



?>