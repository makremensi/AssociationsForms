<?php

namespace App\Controller;

use App\Entity\Arbitres;
use App\Form\ArbitresType;
use App\Repository\ArbitresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/arbitres")
 */
class ArbitresController extends AbstractController
{
    /**
     * @Route("/", name="arbitres_index", methods={"GET"})
     */
    public function index(ArbitresRepository $arbitresRepository): Response
    {
        return $this->render('arbitres/index.html.twig', [
            'arbitres' => $arbitresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="arbitres_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $arbitre = new Arbitres();
        $form = $this->createForm(ArbitresType::class, $arbitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($arbitre);
            $entityManager->flush();

            return $this->redirectToRoute('arbitres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('arbitres/new.html.twig', [
            'arbitre' => $arbitre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="arbitres_show", methods={"GET"})
     */
    public function show(Arbitres $arbitre): Response
    {
        return $this->render('arbitres/show.html.twig', [
            'arbitre' => $arbitre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="arbitres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Arbitres $arbitre): Response
    {
        $form = $this->createForm(ArbitresType::class, $arbitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arbitres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('arbitres/edit.html.twig', [
            'arbitre' => $arbitre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="arbitres_delete", methods={"POST"})
     */
    public function delete(Request $request, Arbitres $arbitre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arbitre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($arbitre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('arbitres_index', [], Response::HTTP_SEE_OTHER);
    }
}
