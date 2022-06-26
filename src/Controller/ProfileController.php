<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
    /**
     * @Route("/profile/editprofil{id}", name="app_profile_edit")
     */
    public function editProfil(Request $request, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $form =$this->createForm(RegistrationFormType::class, $user, ["profile" => true, "sub" => true, "avatar" => true]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $avatar = $form->get('avatar')->getData();
            if ($avatar) 
            {
                $namAvatar = date('') . "_" . uniqid() . "." . $avatar->getClientOriginalExtension();
                $avatar->move(
                    $this->getParameter('imageAvatar'),
                    $namAvatar
                );

                // if($user->getAvatar())
                // {
                //     unlink($this->getParameter('imageAvatar') . "/" . $user->getAvatar() );
                // }
                $user->setAvatar($namAvatar);

            }
            $manager->persist($user);
            $manager->flush();
            
            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/editProfile.html.twig', [
            'user' => $user,
            'formProfile' => $form->createView()
        ]);
    }

}
