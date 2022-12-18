<?php

namespace App\Form;

use App\Entity\Quiz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\QuizRepository;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        

        $builder
            ->add('NumeroQuiz')
            ->add('pro',EntityType::class , [
                'class' =>'App\Entity\User',
                'query_builder' => function($repository){
                    $role = mb_strtoupper('PRO');
                    return $repository->createQueryBuilder('u')
                        ->andWhere('JSON_CONTAINS(u.roles, :role) = 1')
                        ->setParameter('role', '"ROLE_' . $role . '"');

                    },                        
                                     
            ])
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
