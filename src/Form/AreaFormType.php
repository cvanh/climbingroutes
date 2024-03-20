<?php

namespace App\Form;

use App\Entity\Area;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AreaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('parent_id', TextType::class, ['required' => false])
            ->add('name', TextType::class)
            ->add('rock_type', TextType::class)
            ->add('location', TextType::class)
            ->add('description', TextType::class)
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            // ->add('imageFile', VichImageType::class, [
            // 'label' => 'Image', 'required' => false
            // ])
            ->add('save', SubmitType::class, ['label' => 'Create area']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Area::class,
        ]);
    }
}