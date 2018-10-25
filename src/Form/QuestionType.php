<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question_author', HiddenType::class)
            ->add('question_date', HiddenType::class)
            ->add('category_id', ChoiceType::class, array(
                'choices' => array(
                    'Categories' => array (
                        'Wildlife and plants' => 'Wildlife and plants', 
                        'Geography and climate' => 'Geography and climate',
                        'Food and shopping' => 'Food and shopping',
                        'Adventure Experiences' => 'Adventure Experiences',
                        'Cultural Experiences' => 'Cultural Experiences',
                        'Big City Life' => 'Big City Life',
                        'Sun and Surf' => 'Sun and Surf'
                    ),
                ),
            ))
            ->add('question_text', TextareaType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => "Ask"]);
        ;
    }
}
?>