<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */

class ProfileController extends AbstractController
{
    /**
     * @Route("", name="app_profile")
     */
    public function profile(): Response
    {
        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
    /**
     * @Route("/editprofil{id}", name="app_profile_edit")
     */
    public function editProfil(Request $request, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user, ["civil" => true, "avatar" => true, "sub" => true]);
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
    /**
     * @Route("/edit_address{id}", name="app_address")
     */
    public function address(Request $request, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user, ["address" => true, "sub" => true]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_profile');
        }


        return $this->render('profile/editAddress.html.twig', [
            'user' => $user,
            'addressform' => $form->createView()
        ]);
    }
}
