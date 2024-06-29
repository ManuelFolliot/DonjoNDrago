<?php

namespace App\Form;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

// This class is used to create an autocomplete field for the Character entity.
#[AsEntityAutocompleteField]
class CharacterAutocompleteField extends AbstractType
{
    // This method is used to configure the options for the field.
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Character::class,
            'placeholder' => 'Choose a Character',
            'choice_label' => 'name',

            // 'query_builder' => function (CharacterRepository $characterRepository) {
            //     return $characterRepository->createQueryBuilder('character');
            // },
            // 'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
