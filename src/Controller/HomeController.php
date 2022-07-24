<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("", name="app_home")
     */
    public function home(ProduitRepository $repoproduit): Response
    {
        $produits = $repoproduit->findhome();

        return $this->render('home/home.html.twig', [
            'produits' => $produits
        ]);
    }
    /**
     * @Route("about", name="app_about")
     */
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("book_table", name="app_table")
     */
    public function table(): Response
    {
        return $this->render('home/table.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
