<?php

namespace App\Controller;

use App\Entity\BookTable;
use App\Form\BookTableType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookTableController extends AbstractController
{
    /**
     * @Route("/book/table", name="app_book_table")
     */
    public function BookTble(EntityManagerInterface $manager, Request $request): Response
    {
        $table = new BookTable;
        $form = $this->createForm(BookTableType::class, $table);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($table);
            $manager->flush();
        }

        return $this->render('book_table/booktable.html.twig', [
            'booktable' => $form->createView(),
        ]);
    }
}