<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="app_cart")
     */
    public function index(SessionInterface $session, ProduitRepository $repoproduit): Response
    {

        $cart = $session->get("cart", []);

        $datacart = [];
        $total = 0;

        foreach($cart as $id => $quantity){
            $produit = $repoproduit->find($id);
            $datacart[] = [
                "produit" => $produit,
                "quantity" => $quantity
            ];
            $total += $produit->getPrix() * $quantity;
        }

        return $this->render('cart/index.html.twig', compact("datacart", "total")
        );
    }
    /**
     * @Route("/cart/add/{id}", name="app_add_to_cart")
     */
    public function add(Produit $produit, SessionInterface $session): Response
    {


        $cart = $session->get("cart", []);
        $id = $produit->getId();

        if (!empty($cart[$id])) {
            $cart[$id]++;
        }else {
            $cart[$id] = 1;
        }
        $session->set("cart", $cart);
        return $this->redirectToRoute('app_cart', [], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Produit $product, SessionInterface $session)
    {
        
        $cart = $session->get("cart", []);
        $id = $product->getId();

        if(!empty($cart[$id])){
            if($cart[$id] > 1){
                $cart[$id]--;
            }
            // else{
            //     unset($cart[$id]);
            // }
        }

       
        $session->set("cart", $cart);

        return $this->redirectToRoute("app_cart");
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Produit $product, SessionInterface $session)
    {
        // On récupère le panier actuel
        $cart = $session->get("cart", []);
        $id = $product->getId();

        if(!empty($cart[$id])){
            unset($cart[$id]);
        }

        $session->set("cart", $cart);

        return $this->redirectToRoute("app_cart");
    }

    /**
     * @Route("/delete", name="delete_all")
     */
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("cart");

        return $this->redirectToRoute("app_cart");
    }
}
