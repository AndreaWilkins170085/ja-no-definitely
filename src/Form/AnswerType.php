<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\UserAccount;
use App\Entity\Question;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer_author', HiddenType::class, ['data' => $options['currentUsername']])
            // ->add('answer_date', HiddenType::class)
            // ->add('question_id', HiddenType::class)
            ->add('answer_text', TextareaType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => 'Answer!','attr' => ['class' => 'mui-btn mui-btn--primary ask-bt']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Answer',
            'currentUsername' => 'currentUsername'
        ));
    }
}
?>