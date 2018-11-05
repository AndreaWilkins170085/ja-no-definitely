<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, array('label' => false))
        ->add('surname', TextType::class, array('label' => false))
        ->add('username', TextType::class, array('label' => false))
        ->add('email', EmailType::class, array('label' => false))
        ->add('password', PasswordType::class)
        ->add('image_path', HiddenType::class, ['empty_data' => 'default_img.jpg'])
        ->add('submit', SubmitType::class, ['label' => 'Update profile']);
        ;
    }
}
?>