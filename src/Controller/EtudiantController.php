<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Repository\ChambreRepository;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/searching", name="searching_Etudiant")
     */
    function searching(EtudiantRepository $eTRps){
        $alls = $eTRps->findBy(array('matricule' => $_POST['search']));
      $data=array();
        $data['nom']=$alls[0]->getNom();
        $data['prenom']=$alls[0]->getPrenom();
        $data['email']=$alls[0]->getEmail();
        $data['telephone']=$alls[0]->getTelephone();
        $data['adresse']=$alls[0]->getAdresse();
        $data['matricule']=$alls[0]->getMatricule();
        $data['type']=$alls[0]->getType();
        $data['id']=$alls[0]->getId();


        return new JsonResponse( $data );


    }
    /**
     * @Route("/deleteEtudiant", name="delete_Etudiant")
     */
    function deleteEtudiant(EtudiantRepository $etRep){
      $etRep->deleteEtud($_POST['id']);
    }
    /**
     * @Route("/updateEtudiant", name="update_Etudiant")
     */
function updateEtudiant(EtudiantRepository $etReps){
    $etReps->updateEtudi($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['adresse'],$_POST['telephone'],$_POST['id']);
}
    /**
     * @Route("/modifierEtudiant", name="modifier_Etudiant")
     */
    public function modifierEtudiant(EtudiantRepository $etRep){
       $alls= $etRep->find($_POST['id']);
        $data=array();
        $data['nom']=$alls->getNom();
        $data['prenom']=$alls->getPrenom();
        $data['email']=$alls->getEmail();
        $data['telephone']=$alls->getTelephone();
        $data['adresse']=$alls->getAdresse();
        $data['matricule']=$alls->getMatricule();
        $data['type']=$alls->getType();
        $data['id']=$alls->getId();
        return new JsonResponse($data);

    }
    /**
     * @Route("/showListEtudiants", name="show_ListEtudiants")
     */
    public function showListEtudiants(){
          return $this->render('etudiant/listEtudiant.html.twig', [

        ]);
    }
    /**
     * @Route("/listEtudiantsRkk", name="list_Etudiants")
     */
    public function listEtudiants(EtudiantRepository $er){
$data=array();
   // $alls=$er->findAll();
        $alls=$er->findBy(array(),array(),$_POST["limit"],$_POST['offset']);
        for($i=0;$i<count($alls);$i++){
            $data[$i]['nom']=$alls[$i]->getNom();
            $data[$i]['prenom']=$alls[$i]->getPrenom();
            $data[$i]['email']=$alls[$i]->getEmail();
            $data[$i]['telephone']=$alls[$i]->getTelephone();
            $data[$i]['adresse']=$alls[$i]->getAdresse();
            $data[$i]['matricule']=$alls[$i]->getMatricule();
            $data[$i]['type']=$alls[$i]->getType();
            $data[$i]['id']=$alls[$i]->getId();

        }
        // $alls=$er->lister($_POST['limit'],$_POST['offset']);
      //  $service = $er->findAll(array('name' => 'Registration'),array('name' => 'ASC'),$_POST["limit"] ,$_POST["offset"]);


    //$all =$alls->take($_POST['limit'],$_POST['offset']);
    /*    if($_POST["offset"]==0){
            for($i=$_POST["offset"];$i<$_POST["limit"];$i++){
                $data[$i]['nom']=$alls[$i]->getNom();
                $data[$i]['prenom']=$alls[$i]->getPrenom();
                $data[$i]['email']=$alls[$i]->getEmail();
                $data[$i]['telephone']=$alls[$i]->getTelephone();
                $data[$i]['adresse']=$alls[$i]->getAdresse();
                $data[$i]['matricule']=$alls[$i]->getMatricule();
                $data[$i]['type']=$alls[$i]->getType();
                $data[$i]['id']=$alls[$i]->getId();

            }
        }else{
            $max=$_POST["limit"]+7;
            $i=0;
            for($j=$_POST["limit"];$j<$max;$j++){

                $data[$i]['nom']=$alls[$i]->getNom();
                $data[$i]['prenom']=$alls[$i]->getPrenom();
                $data[$i]['email']=$alls[$i]->getEmail();
                $data[$i]['telephone']=$alls[$i]->getTelephone();
                $data[$i]['adresse']=$alls[$i]->getAdresse();
                $data[$i]['matricule']=$alls[$i]->getMatricule();
                $data[$i]['type']=$alls[$i]->getType();
                $data[$i]['id']=$alls[$i]->getId();
$i++;
            }
        }*/

   /* foreach ($alls as $key => $value){
        $data[$key]['nom']=$value->getNom();
    }*/
   // dd($all);

        return new JsonResponse($data);
      //  return $this->render('etudiant/listEtudiant.html.twig', [

        //]);
    }
    /**
     * @Route("/addEtudiant", name="add_etudiant")
     */
    public function index(ChambreRepository $ChambreRepository,Request $request,ChambreRepository $ChambreRepositorys,ChambreRepository $update,ChambreRepository $updates)
    {
        $rooms=$ChambreRepository->getFreeRoom('double');

        $task = new Etudiant();


        $form = $this->createFormBuilder($task)
            ->add('prenom', TextType::class)
            ->add('nom' )
            ->add('email')
            ->add('telephone')
          ->add('date',DateType::class)

         //   ->add('adresse')
         //   ->add('numChambre')
          ->add('type', ChoiceType::class, [
                 'choices'  => [
                  'Choix bourse' => null,
                  'Aucune' => true,
                   '20000' => 20000,
                     '40000' => 40000,
    ],
])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
             function genereNum($num){
                $unik=rand(1000, 9999);
                if(strlen($num)==1){
                    $numChambre="00";
                    $numChambre.=$num;
                    $numChambre.=$unik;

                }
                if(strlen($num)==2){
                    $numChambre="0";
                    $numChambre.=$num;
                    $numChambre.=$unik;
                }
                if(strlen($num)==3){
                    $numChambre=$num;
                    $numChambre.=$unik;
                }
                return $numChambre;
            }
             function genererMat($date,$nom,$prenom)
            {
                $unik=rand(1000, 9999);

                $matricule="";
                $matricule.=$date[0];
                $matricule.=$date[1];
                $matricule.=$date[2];
                $matricule.=$date[3];
                $matricule.=$nom[0];
                $matricule.=$nom[1];
                $tailleP=strlen($prenom);
                $matricule.=$prenom[$tailleP-2];
                $matricule.=$prenom[$tailleP-1];
                $matricule.=$unik;
                $result= strtoupper($matricule);
                return $result;
            }


            $data=$form->getData();
           // dd($data->getDate());
            $date= $data->getDate()->format('Y-m-d ');

            $matricule=genererMat($date,$data->getNom(),$data->getPrenom());
            $task->setNom($data->getNom());
            $task->setMatricule( $matricule);

            $task->setPrenom($data->getPrenom());
            $task->setEmail($data->getEmail());
            $task->setTelephone($data->getTelephone());
            $task->setDate($data->getDate());
            $task->setType($data->getType());
            if(isset($_POST['numChambre']) && !empty($_POST['numChambre']) && $_POST['numChambre']!="") {
                $rom=$ChambreRepositorys->find($_POST['numChambre']);

                $numero=genereNum($rom->getNumBatiment());

                $task->setNumChambre( $numero);

               $update->updateRoom($numero,$_POST['numChambre']);
                if($rom->getType()=='one'){
                    $updates->updateOccuped($_POST['numChambre']);
                }else{
                    if($rom->getOccuped()==null){
                        $updates->updateOccuped($_POST['numChambre']);

                    }else{
                        $updates->updateOccuped2($_POST['numChambre']);

                    }
                }

            }else{
                $task->setAdresse($_POST['adresse']);

            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
        }
        return $this->render('etudiant/index.html.twig', [
            'form' => $form->createView(),
            'rooms'=>$rooms
        ]);
    }


}
