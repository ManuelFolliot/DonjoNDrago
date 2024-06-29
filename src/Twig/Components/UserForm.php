<?php

namespace App\Twig\Components;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsLiveComponent]
class UserForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public ?User $inititalFormData = null;

    public ?string $buttonLabel = "S'inscrire";
    
    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(UserType::class, $this->inititalFormData);
    }
}
