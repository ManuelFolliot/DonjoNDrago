<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

// Voter est une classe qui permet de gérer les droits d'accès des utilisateurs
class UserVoter extends Voter
{

    private $authorizationChecker;

    // on va injecter le service AuthorizationCheckerInterface pour pouvoir l'utiliser dans le voter
    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    // on va definir toutes les actions possible à traiter par le voter
    public const ACCESS = 'USER_ACCESS';
    public const ADMIN_ACCESS = 'ADMIN_ACCESS';


    protected function supports(string $action, mixed $subject): bool
    {
        return in_array($action, [self::ACCESS]);
    }


    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::ACCESS:
                    // si jamais on veut checker les droits d'accès d'un user dans un controller
                    return $this->authorizationChecker->isGranted("ROLE_USER");
                return true;
                break;
        }


        // ce return implique qu'à aucun moment dans la fonction on a return true et donc le voter va bloquer
        return false;
    }
}
