<?php

namespace App\Controller;

use App\Entity\Pilote;
use App\Form\PiloteType;
use App\Repository\PiloteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pilote")
 */
class PiloteController extends AbstractController
{
    /**
     * @Route("/", name="pilote_index", methods={"GET"})
     */
    public function index(PiloteRepository $piloteRepository): Response
    {
        return $this->render('pilote/index.html.twig', [
            'pilotes' => $piloteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pilote_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pilote = new Pilote();
        $form = $this->createForm(PiloteType::class, $pilote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pilote);
            $entityManager->flush();

            return $this->redirectToRoute('pilote_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pilote/new.html.twig', [
            'pilote' => $pilote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pilote_show", methods={"GET"})
     */
    public function show(Pilote $pilote): Response
    {
        return $this->render('pilote/show.html.twig', [
            'pilote' => $pilote,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pilote_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pilote $pilote, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PiloteType::class, $pilote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('pilote_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pilote/edit.html.twig', [
            'pilote' => $pilote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pilote_delete", methods={"POST"})
     */
    public function delete(Request $request, Pilote $pilote, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pilote->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pilote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pilote_index', [], Response::HTTP_SEE_OTHER);
    }
}
