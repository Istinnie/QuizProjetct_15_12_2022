<?php

namespace App\Controller;
use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class APIController extends AbstractController
{
    #[Route('/api/quiz', name: 'app_api_quiz_index')]
    public function index(SerializerInterface $serializer, QuizRepository $quizRepository): Response
    {
        // return $this->render('api/index.html.twig', [
        //     'controller_name' => 'APIController',
        // ]);
        
        $quiz = $serializer->serialize($quizRepository->findAll(), 'json',[]);
        $response = new Response();
        $response->setContent(json_encode([
            'quizzes' => $quiz ,
        ], JSON_OBJECT_AS_ARRAY));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

        
        // $quiz = $quizRepository->findAll();
        // $data =  $serializer->serialize($quiz, 'json', ['groups' => ['normal']]);
        // $response = new Response($data);
        // $response->headers->set('Content-Type', 'application/json');

        // return $response;


    }


    
}
