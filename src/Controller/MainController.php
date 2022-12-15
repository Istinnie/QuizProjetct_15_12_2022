<?php

namespace App\Controller;

use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/app/{id}', name: 'app', methods: ['GET'] )]
    public function index(Quiz $quiz): Response
    {
        return $this->render('main/index.html.twig', [
            'quiz' => $quiz,
        ]);
    }
}
