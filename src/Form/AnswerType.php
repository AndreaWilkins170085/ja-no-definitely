<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\UserAccount;
use App\Entity\Answer;
use App\Entity\Question;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer_author', HiddenType::class)
            ->add('authorId', HiddenType::class)
            // ->add('questionId', ChoiceType::class, array(
            //     'choices' => array(
            //         'Questions' => array (
            //             'At which nature reserves am I most likely to spot the Big Five?' => '1', 
            //             'Are there any venues where I can see some gumboot dancing?' => '2',
            //             'What are some of the best family beaches along the North Coast in KZN?' => '3',
            //             'Where can I find a good stylist in Petermaritzberg?' => '4',
            //             'Looking for the best burgers in Pretoria! Any suggestions?' => '5',
            //             // 'Big City Life' => '6',
            //             // 'Sun and Surf' => '7''
            //         ),
            //     )
            // ))
            ->add('question', ChoiceType::class, array(
                'choices' => array(
                    'Questions' => $options['questions']
                )
            ))
            ->add('answer_text', TextareaType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => 'Answer!','attr' => ['class' => 'mui-btn mui-btn--primary ask-bt']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Answer',
            'questions' => null,
        ));
    }
}
?>