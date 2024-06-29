<?php

namespace App\Form;

use App\Entity\Campaign;
use App\Form\CharacterAutocompleteField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;


class CampaignType extends AbstractType
{
    
    // This method is used to configure the options for the field.
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la campagne',
            ])
            ->add("player", CharacterAutocompleteField::class, [
                'label' => 'Personnages',
                'multiple' => true,
                'expanded' => false,
                'attr'  => [
                    'class' => 'input text-4xl',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de choisir un personnage',
                    ]),
                ],
            ])
            // ->add('gameMaster', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            // ->add('player', EntityType::class, [
            //     'class' => Character::class,
            //     'label' => 'Personnages',
            //     'choice_label' => 'name',
            //     'attr'  => [
            //         'class' => 'input',
            //     ],
            //     'multiple' => true,
            //     'expanded' => false,
            //     'autocomplete' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
        ]);
    }
}
