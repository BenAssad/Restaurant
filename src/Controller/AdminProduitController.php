<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/produit")
 */
class AdminProduitController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_produit_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('admin_produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_produit_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProduitRepository $produitRepository, EntityManagerInterface $manager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit, ["image" => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitRepository->add($produit, true);

            // $produit->setCreatedAt(new \DateTimeImmutable('now'));
            
            $image = $form->get('image')->getData();
            if ($image) 
            {
                $nameImage =  date('YmdHis') . "-" . uniqid() . "." . $image->getClientOriginalExtension();
          
                $image->move(
                    $this->getParameter('imageProduit'),
                    $nameImage
                );
                $produit->setImage($nameImage);
                $manager->persist($produit);
                $manager->flush();


            }

            return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_produit_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('admin_produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_produit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit, ["imageUpdate" => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitRepository->add($produit, true);
            
            $image = $form->get('imageUpdate')->getData();
            if ($image) 
            {
                $nameImage = date('') . "-" . uniqid(). "." . $image->getClientOriginalExtension();
                $image->move(
                    $this->getParameter('imageProduit'),
                    $nameImage
                );
                $produit->setImage($nameImage);

                $manager->persist($produit);
                $manager->flush();
            }

            if($produit->getImage())
                {
                    unlink($this->getParameter('imageProduit') . "/" . $produit->getImage() );
                }

            return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_produit_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_admin_produit_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/book/table/reservation", name="app_reservation")
     */
    public function reservation(): Response
    {


        return $this->render('');
    }
}
