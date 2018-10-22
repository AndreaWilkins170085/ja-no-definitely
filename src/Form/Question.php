<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class Question extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question_author', HiddenType::class)
            ->add('question_date', HiddenType::class)
            ->add('category_id', TextType::class, ['label' => 'Category'])
            ->add('question_text', TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'Ask!']);
        ;
    }
}
?>