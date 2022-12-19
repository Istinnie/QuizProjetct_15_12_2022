<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HomeProController extends AbstractController
{
    #[Route('/home/pro', name: 'app_home_pro')]
    public function index(): Response
    {
        return $this->render('home_pro/index.html.twig', [
            'controller_name' => 'HomeProController',
        ]);
    }

    // #[Route('/client', name: 'app_home_client', methods: ['GET'])]
    // public function index(QuizRepository $quizRepository): Response
    // {
    //     return $this->render('home_client/index.html.twig', [
    //         'quizzes' => $quizRepository->findAll(),
    //     ]);
    // }
}
