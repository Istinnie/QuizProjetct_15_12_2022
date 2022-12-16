<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quiz', TextType::class, [
                'label' => 'Référence du quiz'])
            ->add('NumeroQuestion', TextType::class, [
                'label' => 'N° de question'])
            ->add('LibelleQuestion', TextType::class, [
                'label' => 'Libellé de la question'])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
