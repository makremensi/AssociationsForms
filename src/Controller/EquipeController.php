<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Equipe;
use App\Form\EquipeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;

/**
 *@Route("/equipe", name = "equipe")
*/
class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="add_equipe")
     */
    public function ajouter(Request $request)
    {
//        return $this->render('equipe/index.html.twig', ['controller_name' => 'EquipeController',]);
        $eq = new Equipe();
        $form=$this->createFormBuilder($eq)
        ->add('nom', TextType::class)
        ->add('spcialite', TextType::class)
        ->add('nbJoueurs', IntegerType::class)
        ->add('pays', TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Ajouter'])
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $data=$form->getData();
                $eq->setNom($data->getNom());
                $eq->setPays($data->getPays());
                $eq->setNBJoueurs($data->getNBJoueurs());

                $em = $this->getDoctrine()->getManager();
                $em->persist($eq);
                $em->flush();
                return $this->redirectToRoute('equipeadd_equipe');
            }
        }
        
        return $this->render('equipe/add.html.twig',['controller_name'=>'Equipe Controller','form' => $form->createView()]);

    }
    /**
     * @Route("/add", name="add1_equipe")
     */
    public function add(){
        $eq = new Equipe();
//        $formEquipe = $this->createForm(EquipeType::class,$eq);
        $formEquipe = $this->createForm(EquipeType::class,$eq,
        [
            'action' => $this->generateUrl('equipeadd_equipe'),
            'method' => 'POST',
        ]);
        return $this->render('equipe\add.html.twig',['formEquipe' => $formEquipe->createView()]);
    }
}
