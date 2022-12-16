<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\Resultat;
use App\Entity\Reponse;
use App\Repository\QuizRepository;
use App\Repository\ReponseRepository;
use App\Repository\ResultatRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    // #[Route('/app/{id}', name: 'app', methods: ['GET'] )]
    #[Route('/app/{id}', name: 'app')]
    public function index(Quiz $quiz, QuizRepository $quizRepository, ResultatRepository $resultatRepository, ReponseRepository $reponseRepository): Response
    {
        // 
        $user = $this->getUser();
        // Si un formulaire est posté
        if(isset($_POST)){
            // retrouvé un objet par rapport à son identifiant
            
            // dump($_POST);
            // Récupérer la 1ère clé dans le tableau et non la value
            // La liste des clés de tous les Resultats
            $reponseId = $_POST;
            foreach(array_keys($reponseId) as $key){
                // dump($key);
                $reponse = $reponseRepository->find($key); 
                // On a la réponse, donc on veut le résultat
                $resultat = new Resultat();
                $resultat->setReponse($reponse);
                $resultat->setUserResp($user);
                $resultat->setQuiz($quiz);
                $resultatRepository->save($resultat, true);
            }
             // Récupérer la 1ère clé dans le tableau et non la value
            // $reponseId = array_key_first($_POST);
            // if($reponseId ){
            //     $reponse = $reponseRepository->find($reponseId); 
            //     // On a la réponse, donc on veut le résultat
            //     $resultat = new Resultat();
            //     $resultat->setReponse($reponse);
            //     $resultat->setUserResp($user);
            //     $resultat->setQuiz($quiz);
            //     $resultatRepository->save($resultat, true);
            // }
            $this->addFlash('success','Vos réponses sont bien enregistrées, Merci !');
            // return $this->redirectToRoute('app_quiz_list');
            
            
        }
        

        // Dans tous les résultats, on sélectionne tous les résultats avec le client $user
        $resultatClient = $resultatRepository->findBy(['userResp'=>$user]);
        
        $questions = $quiz->getQuestions();
        $questionClient = [];
        // $questionEnCours = false;
        // on récupère la réponse et la question
        foreach($resultatClient as $resultat){
            $reponse = $resultat->getReponse();
            $q = $reponse->getQuestion();
            array_push($questionClient, $q);
            
        }
        // On veut avoir le tableau de questions
        foreach($questions as $q){

            if (!in_array ($q , $questionClient)){
                return $this->render('main/show.html.twig', [
                    'question' => $q,
                    'quiz' => $quiz,
                ]);

            }
            
            
        }

        // dump($quiz);
        // dump($questions);
        // dump($questionClient);
        

        return $this->render('main/index.html.twig', [
            'quiz' => $quiz,
        ]);
    }

}
