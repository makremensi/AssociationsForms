<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Joueur;
use App\Entity\Equipe;

/**
 *@Route("/joueurs", name = "joueurs")
*/
class JoueurController extends AbstractController
{
    /**
     * @Route("/joueur", name="joueur")
     */
    public function index(): Response
    {
//        return $this->render('joueur/index.html.twig', ['controller_name' => 'JoueurController',]);
        $e = new Equipe();
        $e->setNom('Club Africain');
        $e->setSpcialite('Football');
        $e->setNBJoueurs(23);
        $e->setPays('Tunisie');

        $j = new Joueur();
        $j->setNom('Ben Yahia');
        $j->setPrenom('Wissem');
        $j->setAge(37);
        $j->setNumero(5);

        $j->setEquipe($e);

        $em = $this->getDoctrine()->getManager();

        $em->persist($e);
        $em->persist($j);
        $em->flush();

        return new Response('<html><body> Equipe '.$e->getNom(). ' et joueur '.$j->getPrenom().' '.$j->getNom().' ajoutés avec succes');
    }
/**
 * @Route("/list", name="list_joueur")
 */
    public function list(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $js = $em->getRepository(Joueur::class)->findAll();
        return $this->render('joueur/list.html.twig', ['joueurs' => $js]); 
    }   
}
