<?php
require_once 'Classes/PHPExcel.php';
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 23/03/2018
 * Time: 16:15
 */

class Entretien_devaluation
{
    private $matricule;
    private $date;
    private $score;
    private $date_proche;

    public function modifier_entete($matricule)
    {

        $file = 'templates/aa.xlsx';
        $newfile = 'aa1.xlsx';

        copy($file, $newfile);
        rename($newfile, 'aa1.xlsx');

        $param=new Entreprise();
        $entreprise=$param->get_entreprise();
        $entreprise1=$entreprise->fetch();
        $employe=new Employe();
        $employes=$employe->getemploye_matricule($matricule);
        $emp=$employes->fetch();
        $exprience=round(((strtotime(date("Y-m-d"))-strtotime($emp['date_embauche']))/(24*3600*365)),1);
        $prece=$this->get_entretien_precedent($matricule);
        $req=$this->get_objectif_precedent($prece['date']);
        $obj_prec=$this->concat_objectifs($req);
        $excel = PHPExcel_IOFactory::load('aa1.xlsx');
        $excel->setActiveSheetIndex(0)
            ->setCellValue('B5',$entreprise1['raison_social'])
            ->setCellValue('B11','NOM & PRENOM COLLABORATEUR :'.$emp['nom'].' '.$emp['prenom'])
            ->setCellValue('B13','Poste occupé par le collaborateur :'.$emp['post'])
            ->setCellValue('E16',$emp['respo'])
            ->setCellValue('H12',$emp['date_embauche'])
            ->setCellValue('K12',$exprience)
            ->setCellValue('K13',$prece['date'])
            ->setCellValue('E69',$prece['score'])
            ->setCellValue('E68',$obj_prec);


        $gdImage = imagecreatefromjpeg($entreprise1['logo']);
        // Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($gdImage);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setHeight(120);
        $objDrawing->setCoordinates('B2');
        $objDrawing->setWorksheet($excel->getActiveSheet());


        $file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $file->save('aa1.xlsx');

    }
    public function modifier_tableaux($matricule)
    {

        $file = 'aa1.xlsx';
        $newfile = 'aa2.xlsx';

        copy($file, $newfile);
        rename($newfile, 'aa2.xlsx');
        $date = date("Y-m-d");//  ici ta date
        $date66 =date("Y-m-d", strtotime($date)+24*3600*365);
        $excel = PHPExcel_IOFactory::load('aa1.xlsx');
        $excel->setActiveSheetIndex(0)
            //1 tableau
            ->setCellValue('F26',$_POST['select1'])
            ->setCellValue('F28',$_POST['select2'])
            ->setCellValue('F30',$_POST['select3'])
            ->setCellValue('F32',$_POST['select4'])
            ->setCellValue('F34',$_POST['select5'])
            ->setCellValue('G26',$_POST['comment1'])
            ->setCellValue('G28',$_POST['comment2'])
            ->setCellValue('G30',$_POST['comment3'])
            ->setCellValue('G32',$_POST['comment4'])
            ->setCellValue('G34',$_POST['comment5'])
            ->setCellValue('F37',$_POST['autre1'])
            ->setCellValue('G37',$_POST['comment6'])

            //2 tableau
            ->setCellValue('F45',$_POST['select7'])
            ->setCellValue('F46',$_POST['select8'])
            ->setCellValue('F47',$_POST['select9'])
            ->setCellValue('F48',$_POST['select10'])
            ->setCellValue('F49',$_POST['select11'])
            ->setCellValue('F50',$_POST['select12'])
            ->setCellValue('G45',$_POST['comment7'])
            ->setCellValue('G46',$_POST['comment8'])
            ->setCellValue('G47',$_POST['comment9'])
            ->setCellValue('G48',$_POST['comment10'])
            ->setCellValue('G49',$_POST['comment11'])
            ->setCellValue('G50',$_POST['comment12'])
            ->setCellValue('F51',$_POST['autre2'])
            ->setCellValue('G51',$_POST['comment13'])

            //3 tableau
            ->setCellValue('E57',$_POST['proposition1'])
            ->setCellValue('E58',$_POST['proposition2'])
            ->setCellValue('E59',$_POST['proposition3'])
            ->setCellValue('E60',$_POST['proposition4'])
            ->setCellValue('E61',$_POST['proposition5'])
            ->setCellValue('E62',$_POST['proposition6'])
            ->setCellValue('E63',$_POST['proposition7'])
            ->setCellValue('E64',$_POST['proposition8'])

            //dernier tableau

            ->setCellValue('B100',$_POST['comment_libre_c'])
            ->setCellValue('H100',$_POST['comment_libre_e'])

            // les dates
            ->setCellValue('K15',$date66)
            ->setCellValue('K14',date("Y-m-d"))

            //score
            ->setCellValue('H16','Note Globale de évaluation:            '.$_POST['score']);



        $file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $file->save('aa2.xlsx');

    }
    public function modifier_les_ojectif_court_terme($matricule)
    {

        $file = 'aa2.xlsx';
        $newfile = 'aa3.xlsx';

        copy($file, $newfile);
        rename($newfile, 'aa3.xlsx');

        $objectifs=new Objectif();
        $objectif=$objectifs->get_objectifs($matricule);
        $i=1;
        $g=73;

        $excel = PHPExcel_IOFactory::load('aa2.xlsx');

            //1 tableau
                while(($i<7) and ($req=$objectif->fetch())) {
                    if($req['type']=='court terme')
                    {
                        $x='C'.$g;
                        $y='H'.$g;
                        $z='I'.$g;
                        $chaine='commentaire_court_terme'.$i;
                        $excel->setActiveSheetIndex(0)

                        ->setCellValue($x,$req['objectif'])
                        ->setCellValue($y,$req['Evaluation'])
                        ->setCellValue($z,$_POST[$chaine]);
                        $i++;
                        $g++;

                    }

                }




        $file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $file->save('aa3.xlsx');

    }
    public function modifier_les_ojectif_moyen_terme($matricule)
    {

        $file = 'aa3.xlsx';
        $newfile = 'aa4.xlsx';

        copy($file, $newfile);
        rename($newfile, 'aa4.xlsx');

        $objectifs=new Objectif();
        $objectif=$objectifs->get_objectifs($matricule);
        $i=1;
        $g=82;

        $excel = PHPExcel_IOFactory::load('aa3.xlsx');

        //1 tableau
        while(($i<7) and ($req=$objectif->fetch())) {
            if($req['type']=='moyen terme')
            {
                $x='C'.$g;
                $y='H'.$g;
                $z='I'.$g;
                $chaine='commentaire_moyen_terme'.$i;
                $excel->setActiveSheetIndex(0)

                    ->setCellValue($x,$req['objectif'])
                    ->setCellValue($y,$req['Evaluation'])
                    ->setCellValue($z,$_POST[$chaine]);
                $i++;
                $g++;

            }

        }




        $file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $file->save('aa4.xlsx');

    }
    public function modifier_les_ojectif_long_terme($matricule)
    {

        $file = 'aa4.xlsx';
        $newfile = 'generated/Entretien.xlsx';

        copy($file, $newfile);
        $entretien_name='generated/entretien'.date("Y-m-d").$matricule.'.xlsx';
        rename($newfile, $entretien_name);

        $objectifs=new Objectif();
        $objectif=$objectifs->get_objectifs($matricule);
        $i=1;
        $g=91;

        $excel = PHPExcel_IOFactory::load('aa4.xlsx');

        //1 tableau
        while(($i<7) and ($req=$objectif->fetch())) {
            if($req['type']=='long terme')
            {
                $x='C'.$g;
                $y='H'.$g;
                $z='I'.$g;
                $chaine='commentaire_long_terme'.$i;
                $excel->setActiveSheetIndex(0)

                    ->setCellValue($x,$req['objectif'])
                    ->setCellValue($y,$req['Evaluation'])
                    ->setCellValue($z,$_POST[$chaine]);
                $i++;
                $g++;

            }

        }




        $file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $file->save($entretien_name);

    }
    public function set_entretien($matricule)
    {
        $erreur='';
        if (isset($_POST['score']))
        {

            if (($_POST['score']<=20)and ($_POST['score']>=0))
            {
                $date = date("Y-m-d");//  ici ta date
                $date66 =date("Y-m-d", strtotime($date)+24*3600*365);
                $this->matricule=$matricule;
                $this->date=date("Y-m-d");
                $this->score=$_POST['score'];
                $this->date_proche=$date66;
                return $erreur;

            }
            else
            {
                $erreur='le score inseré est non valide';
                return $erreur;
            }

        }
        else
        {
            return false;
        }
    }
    public function insertion_entretient_das_bdd($matricule)
    {
        $entretien_name='generated/entretien'.date("Y-m-d").$matricule;
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('INSERT INTO entretien (matricule,date,Date_prochaine,score,fichier_excel) VALUES (:matricule,:date,:Date_prochaine,:score,:fichier_excel)');
        $req->execute(array(
           'matricule'=>$this->matricule,
           'date'=>$this->date,
           'Date_prochaine'=>$this->date_proche,
           'score'=>$this->score,
            'fichier_excel'=>$entretien_name,


        ));
    }
    private function get_entretien_precedent($matricule)
    {
        $bdd=connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM entretien WHERE (matricule=?) ORDER BY date DESC');
        $req->execute(array($matricule));
        $req2=$req->fetch();
        return $req2;
    }
    private function get_objectif_precedent($date)
    {
        $bdd = connexion_bdd();
        $req = $bdd->prepare('SELECT * FROM objectif WHERE (date_debut<=?)');
        $req->execute(array($date));
        return $req;
    }
    private function concat_objectifs($req)
    {
        $objectifs_prec='';

        while($req2=$req->fetch())
        {
            $objectifs_prec .=$req2['objectif'];
            $objectifs_prec .= " ";
        }
        return $objectifs_prec;
    }
    public function modifier_excel_annuaire()
    {
        $file = 'templates/annuaire1.xlsx';
        $newfile = 'generated/annuaire.xlsx';

        copy($file, $newfile);
        rename($newfile, 'generated/annuaire.xlsx');
        $employe = new Employe();
        $employes = $employe->getemploye();
        $annuaire=new Entretien_devaluation();
        $i=13;
        $param = new Entreprise();
        $entreprise = $param->get_entreprise();
        $entreprise1 = $entreprise->fetch();
        $excel = PHPExcel_IOFactory::load('generated/annuaire.xlsx');

        while ($employe1 = $employes->fetch()) {



            $x = 'A' . $i;
            $y = 'B' . $i;
            $z = 'C' . $i;
            $w = 'D' . $i;
            $v = 'E' . $i;
            $t = 'F' . $i;

            $excel->setActiveSheetIndex(0)
                //1 tableau

                ->setCellValue($x, $employe1['nom'])
                ->setCellValue($y, $employe1['prenom'])
                ->setCellValue($z, $employe1['post'])
                ->setCellValue($w, $employe1['email'])
                ->setCellValue($v, $employe1['tel'])
                ->setCellValue($t, $employe1['projet'])
                ->setCellValue('B8', $entreprise1['nom_entreprise'])
                ->setCellValue('B9', $entreprise1['raison_social']);
            $i++;
        }
        $gdImage = imagecreatefromjpeg($entreprise1['logo']);
        // Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($gdImage);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setHeight(120);
        $objDrawing->setCoordinates('B1');
        $objDrawing->setWorksheet($excel->getActiveSheet());
        $file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $file->save($newfile = 'generated/annuaire.xlsx');


    }
    public function modifier_excel_historique_des_salaire($matricule)
    {
        $file = 'templates/historique_des_salaires1.xlsx';
        $newfile = 'generated/historique_des_salaires.xlsx';

        copy($file, $newfile);
        rename($newfile, 'generated/historique_des_salaires.xlsx');
        $annuaire=new Entretien_devaluation();
        $i=10;
        $param = new Entreprise();
        $entreprise = $param->get_entreprise();
        $entreprise1 = $entreprise->fetch();
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        $employe=new Employe();
        $emp=$employe->getemploye_matricule($matricule);
        $emp1=$emp->fetch();
        $salaire = $employe->getemploye_historique($matricule);
        $excel = PHPExcel_IOFactory::load('generated/historique_des_salaires.xlsx');

        while ($salaire1 = $salaire->fetch()) {
            $x = 'B' . $i;
            $y = 'C' . $i;
            $excel->setActiveSheetIndex(0)
                ->setCellValue($x, $salaire1['montant'])
                ->setCellValue($y, $salaire1['date'])

                ->setCellValue('B4', $entreprise1['nom_entreprise'])
                ->setCellValue('B5', $emp1['nom'])
                ->setCellValue('B6', $emp1['prenom'])
                ->setCellValue('B7', $emp1['matricule']);
            $i++;
        }
        $gdImage = imagecreatefromjpeg($entreprise1['logo']);
        // Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
        $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
        $objDrawing->setName('Sample image');
        $objDrawing->setDescription('Sample image');
        $objDrawing->setImageResource($gdImage);
        $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
        $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
        $objDrawing->setHeight(120);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($excel->getActiveSheet());
        $file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $file->save($newfile = 'generated/historique_des_salaires.xlsx');


    }
    public function tout_les_entretiens($matricule)
    {
        $bdd=$this->connexion_bdd();
        $req=$bdd->prepare('SELECT * FROM entretien WHERE (matricule=?)');
        $req->execute(array($matricule));
        return $req;
    }
    public function supprimer_fichier($name)
    {
         unlink($name);
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

    public static function getEntretienParMois($mois)
    {
        $year=date("Y");
        $dateLim1=($year."-".$mois."-01");
        $dateLim2=($year."-".$mois."-31");
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->prepare('SELECT  *
                                        FROM entretien
                                        WHERE date > ? AND date < ?            ');
        $reponse->execute(array($dateLim1,$dateLim2));
        return $reponse->rowCount();
    }

    public static function getEntretienparMoisTotal()
    {

            for ($i=1;$i<13;$i++)
            {
                $entretien[$i]=self::getEntretienParMois($i);
            }



        return $entretien;
    }

    public static function getEntretienAujourdhui()
    {
        $bdd=Utilitaire::connexion_bdd();
        $reponse=$bdd->query('SELECT entretien.id AS id , entretien.date AS date , employe.nom AS nom ,employe.prenom AS prenom 
                                        FROM `entretien`
                                        INNER JOIN `employe`
                                        ON `employe`.`matricule`=`entretien`.`matricule`
                                        WHERE `entretien`.`date`=CURDATE();            ');

        return $reponse;
    }

}
?>