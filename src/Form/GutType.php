<?php

namespace App\Form;

use App\Entity\Gut;
use App\Entity\Reaction;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GutType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('reaction', ChoiceType::class, [
                    'choices' => [
                        'Barf' => 'Barf',
                        'Big D' => 'Big D',
                        'Loose' => 'Loose',
                        'Mush' => 'Mush',
                        'Nausea' => 'Nausea',
                        'Normal' => 'Normal',
                        'Pain, gut' => 'Pain, gut',
                    ],
                    'label' => false,
                    'expanded' => false,
                    'multiple' => false,
                ])
                ->add('description', TextareaType::class, [
                    'label' => 'Comment',
                ])
                ->add('happened', DateTimeType::class, [
                    'attr' => ['class' => 'js-datepicker'],
                    'date_widget' => 'single_text',
                    'time_widget' => 'single_text',
                    'input' => 'datetime',
                    'years' => [2022, 2023],
                    'attr' => ['style' => 'width: 300px;'],
                    'placeholder' => '',
                ])
//                ->add('delay', ChoiceType::class, [
//                    'choices' => [
//                        '2' => 2,
//                        '3' => 3,
//                        '4' => 4,
//                    ],
//                    'label' => 'Delay (days)',
//                    'expanded' => true,
//                    'multiple' => false,
//                    'mapped' => false,
//                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gut::class,
        ]);
    }

}
