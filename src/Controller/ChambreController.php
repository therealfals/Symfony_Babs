<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use App\Repository\ChambreRepository;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChambreController extends AbstractController
{
    /**
     * @Route("/deleteRooms", name="delete_Rooms")
     */
    function deleteRooms(ChambreRepository $po){
    $po->supRoom($_POST['id']);
    }

    /**
     * @Route("/updateRooms", name="update_Rooms")
     */
    function updateRooms(ChambreRepository $c){
        $c->modRoom($_POST['numBatiment'],$_POST['type'],$_POST['id']);
    }

    /**
     * @Route("/modifChambre", name="modif_Chambre")
     */
    function modifChambre(ChambreRepository $cc){
        $alls=$cc->find($_POST['id']);

        $data['id']=$alls->getId();
        $data['numero']=$alls->getNumero();
        $data['numBatiment']=$alls->getNumBatiment();
        $data['type']=$alls->getType();
        return new JsonResponse($data);

    }
    /**
     * @Route("/listChambres", name="list_ListChambre")
     */
public function listChambres(ChambreRepository $chr){
    $alls= $chr->findAll();



    //$all =$alls->take($_POST['limit'],$_POST['offset']);
    for($i=0;$i<count($alls);$i++){
        $data[$i]['id']=$alls[$i]->getId();
        $data[$i]['numero']=$alls[$i]->getNumero();
        $data[$i]['numBatiment']=$alls[$i]->getNumBatiment();
        $data[$i]['type']=$alls[$i]->getType();


    }
    return new JsonResponse($data);
}

    /**
     * @Route("/showListChambre", name="show_ListChambre")
     */
    public function showListChambre(){
        return $this->render('chambre/listChambre.html.twig', [

        ]);
    }
    /**
     * @Route("/addChambre", name="add_chambre")
     */
    public function index(Request $request)
    {
        $chambre = new Chambre();


        $formChambre = $this->createFormBuilder($chambre)
            ->add('numBatiment', IntegerType::class)


            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Choix bourse' => null,
                    'Type de chambre' => null,
                    'Unique' => 'one',
                    'Double' => 'double',
                ],
            ])
            ->getForm();
        $chambre = new Chambre();
       // $form = $this->createForm(Chambre::class,$chambre);
        $formChambre->handleRequest($request);
        if($formChambre->isSubmitted() && $formChambre->isValid()){


            $data=$formChambre->getData();

            $chambre->setNumBatiment($data->getNumBatiment());
            $chambre->setType($data->getType());
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();
        }
        return $this->render('chambre/index.html.twig', [
            'formChambre' => $formChambre->createView(),
        ]);
    }

}
