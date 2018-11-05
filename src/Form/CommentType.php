<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment_author', HiddenType::class)
            ->add('comment_text', TextareaType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => 'Comment','attr' => ['class' => 'mui-btn mui-btn--primary ask-bt']]);
        ;
    }
}
?>