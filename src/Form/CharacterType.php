<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Race;
use App\Entity\User;
use App\Entity\Alignment;
use App\Entity\Character;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CharacterType extends AbstractType
{
    // This method is used to configure the options for the field.
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du personnage',
            ])
            ->add('characterAvatarUrl', TextType::class, [
                'label' => 'Choisissez votre avatar',
                'empty_data' => 'avatar0.svg'
            ])
            ->add('age', NumberType::class, [
                'label' => 'Age du personnage',
                'attr' => ['min' => 1, 'max' => 99],
            ])
            ->add('background', TextareaType::class, [
                'label' => 'Son histoire',
                'attr'  => ['rows' => 5, "class" => "input"],
            ])
            ->add('statStrength', NumberType::class, [
                'label' => 'Force',
                'html5' => true,
                'attr' => ['min' => 1, 'max' => 99],
            ])
            ->add('statDexterity', NumberType::class, [
                'label' => 'Dextérité',
                'html5' => true,
                'attr' => ['min' => 1, 'max' => 99],
            ])
            ->add('statEndurance', NumberType::class, [
                'label' => 'Endurance',
                'html5' => true,
                'attr' => ['min' => 1, 'max' => 99],
            ])
            ->add('statIntelligence', NumberType::class, [
                'label' => 'Intelligence',
                'html5' => true,
                'attr' => ['min' => 1, 'max' => 99],
            ])
            ->add('statWisdom', NumberType::class, [
                'label' => 'Sagesse',
                'html5' => true,
                'attr' => ['min' => 1, 'max' => 99],
            ])
            ->add('statCharisma', NumberType::class, [
                'label' => 'Charisme',
                'html5' => true,
                'attr' => ['min' => 1, 'max' => 99],
            ])
            ->add('alignment', EntityType::class, [
                'label' => "Selection de l'alignement",
                'class' => Alignment::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => false,
                'empty_data' => "default",
            ])
            ->add('job', EntityType::class, [
                'label' => 'Sélection de la classe',
                'class' => Job::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => false,
                'empty_data' => "default",
            ])
            ->add('race', EntityType::class, [
                'label' => 'Sélection de la race',
                'class' => Race::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => false,
                'empty_data' => "default",
            ]);
        // ->add('user', EntityType::class, [
        //     'class' => User::class,
        //     'choice_label' => 'id',
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class
        ]);
    }
}
