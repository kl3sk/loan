<?php

namespace App\Form;

use App\Entity\Stuff;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StuffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('lendAt', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'd-none',
                    'is' => 'date-picker',
                    'inline' => 'true'
                ]
            ])
            // ->add('returnedAt')
            ->add('stuffImages', CollectionType::class, [
                'entry_type' => StuffImageType::class,
                'entry_options' => [
                    'label' => false
                ],
                'attr' => [
                    'data-allow-add' => true,
                    'data-allow-delete' => true,
                ],
                'by_reference' => false,
                'allow_delete' => true,
                'allow_add' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stuff::class,
        ]);
    }
}
