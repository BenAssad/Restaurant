<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("produit")
 */

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="app_produit")
     */
    public function index(): Response
    {
        return $this->render('produit/fiche_produit.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    /**
     * @Route("/afficher", name="app_afficher")
     */
    public function Afficher(ProduitRepository $reproduit): Response
    {
        $produits = $reproduit->findAll();
        return $this->render('produit/fiche_produit.html.twig', [
            "produits" => $produits,
        ]);
    }
    /**
     * @Route("/catalogue", name="app_catalogue")
     */
    public function catalogue(ProduitRepository $reproduit): Response
    {
        $produits = $reproduit->findAll();
        return $this->render('produit/catalogue.html.twig', [
            "produits" => $produits,
        ]);
    }
}
