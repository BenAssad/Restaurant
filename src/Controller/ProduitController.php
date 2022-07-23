<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Produit;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/afficher/{id}", name="app_afficher")
     */
    public function Afficher(Produit $produit, Request $request, EntityManagerInterface $manager, CommentRepository $repocomment): Response
    {
        $comments = $repocomment->findBy([
            "produit" => $produit
        ]);
        
        $comment = new Comment;
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) 
        {
            $userC0 = $this->getUser();
            $comment->setDateAt(new \DateTimeImmutable('now'));
            $comment->setProduit($produit);
            $comment->setUser($userC0);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('app_afficher', ['id' =>$produit->getId()]);
        }

        return $this->render('produit/fiche_produit.html.twig', [
            "produits" => $produit,
            "fComment" => $form->createView(),
            "comments" => $comments
        ]);
    }
    /**
     * @Route("/catalogue", name="app_catalogue")
     */
    public function catalogue(ProduitRepository $reproduit, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $reproduit->findAll();
        $produits = $paginator->paginate(
            $data,
            $request->query->getInt('page' , 1),
            9
        );
        return $this->render('produit/catalogue.html.twig', [
            "produits" => $produits,
        ]);
    }
}
