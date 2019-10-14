<?php
/**
 * Created by PhpStorm.
 * User: ga_na
 * Date: 3/4/2018
 * Time: 4:04 PM
 */

require ('controller/controller.php');

if (verif_connexion()==0)
{
    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'page_recup_passwd') {
            require("view/recuperation_password.php");
        } elseif ($_GET['action'] == 'recup_passwd') {

            envoie_du_mail_de_recup();

        } elseif ($_GET['action'] == 'reinitialisation_password_affiche') {
            require("view/recup_password_lien_mail.php");
        } elseif ($_GET['action'] == 'reinitialisation_password') {
            reinitialisation_password();
        } elseif ($_GET['action'] == 'new_password_affche') {
            require("view/new_password.php");
        } elseif ($_GET['action'] == 'new_password') {
            new_password();
        } elseif($_GET['action']=='accueil'){
            c_connexion();
        }
    }
    else{
        c_connexion();
    }


}
else
{
    if (isset($_GET['action']))
    {

        if($_GET['action']=='ajouter_admin_gestionnaire')
        {
            ajouter_admin_gestionnaire();
        }
        elseif ($_GET['action']=='affichage_comptes')
        {
            affichage_comptes();
        }

        elseif ($_GET['action']=='ajouter_employe')
        {
            ajouter_employe();
        }
        elseif ($_GET['action']=='list_conge_pass')
        {
            listConges_pass();
        }
        elseif ($_GET['action']=='list_conge_prez')
        {
            listConges_prez();
        }
        elseif ($_GET['action']=='list_conge_venir')
        {
            listConges_venir();
        }
        elseif (($_GET['action']=='list_conge_employe')&&(isset($_GET['matricule'])))
        {
            listConges_employe($_GET['matricule']);
        }
        elseif ($_GET['action']=='ajout_conge')
        {
            ajoutConge();
        }
        elseif ($_GET['action']=='affich_ajout_conge')
        {
            affich_ajoutConge("");
        }
        elseif(($_GET['action']=='supprimer_conge')&&(isset($_GET['id'])))
        {
            supprimerConge($_GET['id']);
        }
        elseif(($_GET['action']=='arreter_conge')&&(isset($_GET['id'])))
        {
            arreterConge($_GET['id']);
        }
        elseif (($_GET['action']=='modifier_conge')&&(isset($_GET['id'])))
        {
            modifierConge($_GET['id']);
        }
        elseif (($_GET['action']=='affich_modifier_conge_prez')&&(isset($_GET['id'])))
        {
            affich_modifierConge_prez($_GET['id'],"");
        }
        elseif (($_GET['action']=='affich_modifier_conge_venir')&&(isset($_GET['id'])))
        {
            affich_modifierConge_venir($_GET['id'],"","");
        }
        elseif ($_GET['action']=='affich_ajoutCompte')
        {
            affich_ajoutCompte("");
        }
        elseif($_GET['action']=='affich_ajoutEmploye')
        {
            $errors['exists']=0;
            affich_ajoutEmploye($errors);
        }
        elseif (($_GET['action']=='supprimer_compte')&&(isset($_GET['id'])))
        {
            supprimer_compte();
        }
        elseif (($_GET['action']=='affiche_compte_modifier')&&(isset($_GET['id'])))
        {
            affich_compte_modification($_GET['id'],"");

        }
        elseif (($_GET['action']=='modifier_compte')&&(isset($_GET['id'])))
        {
            modifier_compte($_GET['id']);
        }
        elseif ($_GET['action']=='list_employes')
        {
            affichage_employes();
        }
        elseif(($_GET['action']=='modifier_employe_affiche')&&(isset($_GET['id'])))
        {
            $errors['exists']=0;
            affichage_employe_modification($_GET['id'],$errors);
        }
        elseif(($_GET['action']=='modifier_employe')&&(isset($_GET['id'])))
        {
            modification_employe($_GET['id']);
        }
        elseif(($_GET['action']=='contrat_input')&&(isset($_GET['id'])))
        {
            contrat_input($_GET['id'],'success');
        }
        elseif(($_GET['action']=='contrat_modif')&&(isset($_GET['id'])))
        {
            contrat_modif($_GET['id']);
        }

        elseif(($_GET['action']=='info_employe')&&(isset($_GET['id'])))
        {
            affichage_employe_modification2($_GET['id']);
        }
        elseif(($_GET['action']=='desactiveEmploye')&&(isset($_GET['id'])))
        {
            desactiveEmploye($_GET['id']);
        }
        elseif(($_GET['action']=='reactiveEmploye')&&(isset($_GET['id'])))
        {
            reactiveEmploye($_GET['id']);
        }
        elseif($_GET['action']=='modification_entreprise_afiiche')
        {
            affichage_parametre_entrprise();
        }
        elseif($_GET['action']=='modification_entreprise_afiiche2')
        {
            affichage_parametre_entrprise2('');
        }
        elseif($_GET['action']=='modifier_entreprise')
        {
            modification_parametres_entreprise();
        }
        elseif (($_GET['action']=='historique_salaire')And (isset($_GET['id'])))
        {
          affiche_salaire_historique($_GET['id']);
        }
        elseif ($_GET['action']=='ajouter_candidat')
        {
            ajouter_candidat();
        }
        elseif ($_GET['action']=='list_candidat')
        {
            listcandidat();
        }elseif(($_GET['action']=='modifier_candidat_affiche')&&(isset($_GET['id'])))
        {
            affichage_candidat_modification($_GET['id'],'');
        }
        elseif(($_GET['action']=='modifier_candidat')&&(isset($_GET['id'])))
        {
            modification_candidat($_GET['id']);
        }
        elseif($_GET['action']=='affich_ajoutcandidat')
        {
            affich_ajoutcandidat('');
        }
        elseif(($_GET['action']=='info_candidat')&&(isset($_GET['id'])))
        {
            affichage_candidat_modification2($_GET['id']);
        }
        elseif (($_GET['action']=='genererAttestation')&&isset($_GET['id']))
        {
            generateAttestation($_GET['id']);
        }
        elseif (($_GET['action']=='genererCertificat')&&isset($_GET['id']))
        {
            generateCertificat($_GET['id']);
        }
        elseif (($_GET['action']=='genererContrat')&&isset($_GET['id']))
        {
            generateContrat($_GET['id']);
        }
        elseif (($_GET['action']=='genererTitreConge')&&isset($_GET['id']))
        {
            generateTitreConge($_GET['id']);
        }
        elseif(($_GET['action']=='affichage_objectifs')&&(isset($_GET['matricule'])))
        {
            affichage_des_objectif($_GET['matricule']);
        }
        elseif(($_GET['action']=='ajouter_objectif')&&(isset($_GET['matricule'])))
        {

            ajouter_objectif($_GET['matricule']);
        }
        elseif(($_GET['action']=='supprimer_objectif')&&(isset($_GET['matricule']))&&(isset($_GET['id'])))
        {
            supprimer_objectif($_GET['id'],$_GET['matricule']);
        }
        elseif ($_GET['action']=='affiche_page_ajouter_objectif')
        {
            affiche_page_ajouter_objectif('');
        }
        elseif (($_GET['action']=='ajouter_entretien')&&(isset($_GET['matricule'])))
        {
            affichage_objectif_critere($_GET['matricule']);
        }
        elseif (($_GET['action']=='affichage_entretiens')&&(isset($_GET['matricule'])))
        {
            affichage_entretiens($_GET['matricule']);
        }
        elseif (($_GET['action']=='modifier_affich__objectif')&&(isset($_GET['matricule']))&&(isset($_GET['id'])))
        {
            affichage_modif_objectif($_GET['id'],$_GET['matricule'],'');
        }
        elseif (($_GET['action']=='modifier_objectif')&&(isset($_GET['matricule']))&&(isset($_GET['id'])))
        {
            modification_objectif($_GET['id'],$_GET['matricule']);
        }
        elseif (($_GET['action']=='affichage_entretien')&&(isset($_GET['matricule'])))
        {
            affichage_objectif_critere2($_GET['matricule'],'');
        }
        elseif (($_GET['action']=='telecharger_excel')&&(isset($_GET['matricule'])))
        {
            telecharger_entretien($_GET['matricule']);
        }
        elseif ($_GET['action']=='telecharger_annuaire')
        {
            telecharger_annuaire();
        }
        elseif (($_GET['action']=='telecharger_historique')&&(isset($_GET['matricule'])))
        {
            telecharger_historique($_GET['matricule']);
        }

        ////////////////////////embauche entretiens index////////////////////
        elseif ($_GET['action']=='liste_entretiens_candidat'&&(isset($_GET['matricule'])))
        {
            liste_entretiens_candidat($_GET['matricule']);
        }elseif ($_GET['action']=='list_entretien_today')
        {
            listembauchetoday();
        }elseif ($_GET['action']=='list_entretien_pass')
        {
            listembauchepass();
        }elseif ($_GET['action']=='list_entretien_venir')
        {
            listembauchefutur();
        }

       elseif($_GET['action']=='affich_ajoutembauche'&&(isset($_GET['where'])))
        {  if (isset($_GET['id'])){
            $id =$_GET['id'];

        }

           affich_ajoutembauche($_GET['where'],'');
        }
        elseif ($_GET['action']=='ajouter_embauche'&&(isset($_GET['where'])))
        {
            ajouter_embauche($_GET['where']);
        }
        elseif(($_GET['action']=='info_embauche')&&(isset($_GET['id']))&&(isset($_GET['where'])))
        {
            affichage_embauche_modification2($_GET['id'],$_GET['where']);
        }
        elseif(($_GET['action']=='supprimer_embauche')&&(isset($_GET['id']))&&(isset($_GET['where'])))
        {
            supprimerembauche($_GET['id'],$_GET['where']);
        }elseif(($_GET['action']=='report_embauche1')&&(isset($_GET['id']))&&(isset($_GET['where'])))
        {
            reportembauche1($_GET['id'],$_GET['where'],'');
        }elseif(($_GET['action']=='report_embauche')&&(isset($_GET['id']))&&(isset($_GET['where'])))
        {
            reportembauche($_GET['id'],$_GET['where']);
        }
        elseif(($_GET['action']=='modifier_embauche_affiche')&&(isset($_GET['id']))&&(isset($_GET['where'])))
        {
            affichage_embauche_modification($_GET['id'],$_GET['where'],'');
        } elseif(($_GET['action']=='commencer_embauche_affiche')&&(isset($_GET['id']))&&(isset($_GET['where'])))
        {
            affichage_commencer_embauche($_GET['id'],$_GET['where'],'');
        }elseif(($_GET['action']=='commencer')&&(isset($_GET['id']))&&(isset($_GET['where'])))
        {
            commencer($_GET['id'],$_GET['where']);
        }
        elseif(($_GET['action']=='modifier_embauche')&&(isset($_GET['id']))&&(isset($_GET['where'])))
        {
            modification_embauche($_GET['id']);
        }elseif(($_GET['action']=='suite_embauche')&&(isset($_GET['id']))&&(isset($_GET['where']))) {
            suite_embauche($_GET['id'], $_GET['where']);
        }//////////questions//////////////
        elseif(($_GET['action']=='supprimer_question')&&(isset($_GET['id']))&&(isset($_GET['where']))&&(isset($_GET['emb'])))
        {
            supprimerquestion($_GET['id'],$_GET['emb'],$_GET['where']);
        }elseif(($_GET['action']=='modifier_question_affiche')&&(isset($_GET['id']))&&(isset($_GET['where']))&&(isset($_GET['emb'])))
        {
            affichage_question_modification($_GET['id'],$_GET['emb'],$_GET['where']);
        }
        elseif(($_GET['action']=='modifier_question')&&(isset($_GET['id']))&&(isset($_GET['where']))&&(isset($_GET['emb'])))
        {
            modification_question($_GET['id'],$_GET['emb'],$_GET['where']);
        }
        elseif($_GET['action']=='affich_ajoutquestion'&&(isset($_GET['id']))&&(isset($_GET['where']))&&(isset($_GET['emb'])))
        {
            affich_ajoutquestion($_GET['id'],$_GET['emb'],$_GET['where']);
        } elseif (($_GET['action']=='ajouter_question')&&(isset($_GET['where']))&&(isset($_GET['emb'])))
        {
            ajouter_question($_GET['emb'],$_GET['where']);
        }elseif($_GET['action']=='affichaccepter'&&(isset($_GET['id']))&&(isset($_GET['where'])))
        {
            affichaccepter($_GET['id'],0,$_GET['where']);
        } elseif (($_GET['action']=='accepter')&&(isset($_GET['where']))&&(isset($_GET['id'])))
        {
            accepter($_GET['id'],$_GET['where']);
        }
        elseif (($_GET['action']=='ajouter_question1')&&(isset($_GET['where']))&&(isset($_GET['emb'])))
        {
            ajouter_question1($_GET['emb'],$_GET['where']);
        }
        elseif($_GET['action']=='affich_ajoutquestion1'&&(isset($_GET['id']))&&(isset($_GET['where']))&&(isset($_GET['emb'])))
        {
            affich_ajoutquestion1($_GET['id'],$_GET['emb'],$_GET['where']);
        }
        elseif($_GET['action']=='list_embauche'&&(isset($_GET['where']))/*&&(isset($_GET['idc']))*/)
        {
            list_embauche($_GET['where']/*,$_GET['idc']*/);
        }
        elseif($_GET['action']=='deconnect')
        {
            c_deconnexion();
            c_connexion();
        }
        elseif($_GET['action']=='acces_refuse')
        {
            acces_refuse();
        }
        elseif($_GET['action']=='affichage_conge_global')
        {
            listCongeGlobal();
        }




}
    else
    {
        accueil();
    }

}
