<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="app_produit")
     */
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    /**
     * @Route("/afficher", name="app_afficher")
     */
    public function Afficher(ProduitRepository $reproduit): Response
    {
        $produits = $reproduit->findAll();
        return $this->render('produit/index.html.twig', [
            "produits" => $produits,
        ]);
    }
}
