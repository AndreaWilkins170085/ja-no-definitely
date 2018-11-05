<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('submitBan', SubmitType::class, ['label' => 'Ban User'])
        ->add('submitUnban', SubmitType::class, ['label' => 'Unban User']);
        ;
    }
}
?>