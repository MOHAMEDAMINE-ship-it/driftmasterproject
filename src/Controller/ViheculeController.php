<?php

namespace App\Controller;

use App\Entity\Vihecule;
use App\Form\ViheculeType;
use App\Repository\ViheculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vihecule")
 */
class ViheculeController extends AbstractController
{
    /**
     * @Route("/", name="vihecule_index", methods={"GET"})
     */
    public function index(ViheculeRepository $viheculeRepository): Response
    {
        return $this->render('vihecule/index.html.twig', [
            'vihecules' => $viheculeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vihecule_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vihecule = new Vihecule();
        $form = $this->createForm(ViheculeType::class, $vihecule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vihecule);
            $entityManager->flush();

            return $this->redirectToRoute('vihecule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vihecule/new.html.twig', [
            'vihecule' => $vihecule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vihecule_show", methods={"GET"})
     */
    public function show(Vihecule $vihecule): Response
    {
        return $this->render('vihecule/show.html.twig', [
            'vihecule' => $vihecule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vihecule_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Vihecule $vihecule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ViheculeType::class, $vihecule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('vihecule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vihecule/edit.html.twig', [
            'vihecule' => $vihecule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vihecule_delete", methods={"POST"})
     */
    public function delete(Request $request, Vihecule $vihecule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vihecule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vihecule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vihecule_index', [], Response::HTTP_SEE_OTHER);
    }
}
