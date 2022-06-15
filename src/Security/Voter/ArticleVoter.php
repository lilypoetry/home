<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class ArticleVoter extends Voter
{
    public const DELETE = 'ARTICLE_DELETE';
    // public const VIEW = 'POST_VIEW';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::DELETE])
            && $subject instanceof \App\Entity\Article;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // Si ADMIN, alors il a toutes les autorisations
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }
        
        /** @var Article $article */
        $article = $subject;


        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::DELETE:
                return $article->getAuthor() === $user->getAuthor(); // comparaison les deux
                // return $article->getAuthor()->getUser() === $user;
                break;
        }

        return false;
    }
}
