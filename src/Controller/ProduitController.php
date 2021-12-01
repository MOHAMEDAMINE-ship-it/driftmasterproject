<?php

namespace App\Controller;
use APP\Entity\Image;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="produit_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
    /**
     * @Route("/front", name="produit_index1", methods={"GET"})
     */
    public function index1(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index1.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
    /**
     * @Route("/front2", name="produit_index2", methods={"GET"})
     */
    public function index2(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index2.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
    /**
     * @Route("/listp", name="produit_list", methods={"GET"})
     */
    public function listep(ProduitRepository $produitRepository): Response
    {     
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $produits= $produitRepository->findAll();
        
            
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('produit/listp.html.twig', [
            'produits'=> $produits,
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
        
    
        
    /**
     * @Route("/new", name="produit_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on recupere les images transmises
            $images= $form->get('images')->getData();
            //on boucle sur les images 
            foreach($images as $image){
                //on genre un nouveau nom de fichier
                $fichier=md5(uniqid()) .'.'.$image->guessExtension();
                //on copie le ficher dans le dossier uploads
                $image->move(
                   $this->getParameter('images_directory'),
                   $fichier
                );
                // on stocke l'image dans notre base de donne
                $img= new Image();
                $img->setName($fichier);
                $produit->addImage($img);}

        
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit_index', [], Response::HTTP_SEE_OTHER);
            }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="produit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             //on recupere les images transmises
             $images= $form->get('images')->getData();
             //on boucle sur les images 
             foreach($images as $image){
                 //on genre un nouveau nom de fichier
                 $fichier=md5(uniqid()) .'.'.$image->guessExtension();
                 //on copie le ficher dans le dossier uploads
                 $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                 );
                 // on stocke l'image dans notre base de donne
                 $img= new Image();
                 $img->setName($fichier);
                 $produit->addImage($img);}
 
            $entityManager->flush();

            return $this->redirectToRoute('produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
