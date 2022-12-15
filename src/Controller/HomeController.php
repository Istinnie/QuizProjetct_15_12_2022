<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
<<<<<<< HEAD
    #[Route('/', name: 'app_home')]
=======
    #[Route('/home', name: 'app_home')]
>>>>>>> 65619f0b6904f2682c64c9e41337ffc73937d9b3
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
