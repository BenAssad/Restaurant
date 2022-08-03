<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("", name="app_home")
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig', [
            
        ]);
    }
    /**
     * @Route("", name="app_home")
     */
    public function commentaire(CommentRepository $repocomment, ProduitRepository $repoproduit): Response
    {
        $comments = $repocomment->findAll();
       

        return $this->render('home/home.html.twig', [
            'comments' => $comments,
            'produits' => $repoproduit->findhome()
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
}
