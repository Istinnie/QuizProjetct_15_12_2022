<?php

namespace App\Controller;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Form\AddUserClientType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeClientController extends AbstractController
{
    #[Route('/client', name: 'app_home_client')]
    public function index(): Response
    {   
        
        return $this->render('home_client/index.html.twig', [
            'controller_name' => 'HomeClientController',
        ]);
    }
    // #[Route('/register/app/client', name:'app_home_client_pro')]
    // public function usersList(UserRepository $users)
    // {
    //     return $this->render('home_client/addUserClient.html.twig');
    // }

    #[Route('/register/client', name: 'app_register_client')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(AddUserClientType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            $entityManager->persist($user);
            $entityManager->flush();
            

            return $this->redirectToRoute('app_home');
            // return $this->render('home_client/index.html.twig');
        }

        return $this->render('home_client/addUserClient.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }
}




