<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer_author', HiddenType::class)
            ->add('answer_date', HiddenType::class)
            ->add('question_id', HiddenType::class)
            ->add('answer_text', TextareaType::class)
            ->add('submit', SubmitType::class, ['label' => 'Answer!']);
        ;
    }
}
?>