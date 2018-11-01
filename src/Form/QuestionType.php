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
use App\Entity\Category;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // $categories = $this->getDoctrine()
        // ->getRepository(Category::class)
        // ->findAll();

        $builder
            ->add('question_author', HiddenType::class, ['data' => '{{ user.id }}'])
            ->add('question_date', HiddenType::class)
            ->add('category', ChoiceType::class, array(
                'choices' => array(
                    // 'Categories' => array (
                    //     'Wildlife and plants' => 1, 
                    //     'Geography and climate' => 2,
                    //     'Food and shopping' => 3,
                    //     'Adventure Experiences' => 4,
                    //     'Cultural Experiences' => 5,
                    //     'Big City Life' => 6,
                    //     'Sun and Surf' => 7
                    // ),
                    // //$categories
                    'Categories' => $options['categories']
                )
            ))
            ->add('question_text', TextareaType::class, ['label' => false])
            ->add('submit', SubmitType::class, ['label' => "Ask", 'attr' => ['class' => 'mui-btn mui-btn--primary ask-bt']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Question',
            'categories' => null
        ));
    }
}
?>