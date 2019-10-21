<?php


namespace App\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $current_user = $token->getUser();

        if (!$current_user instanceof User) {
            return false;
        }

        $user = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($user, $current_user);
            case self::EDIT:
                return $this->canEdit($user, $current_user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(User $user, User $current_user)
    {
        if($this->canEdit($user, $current_user)) {
            return true;
        }

        return !$user->isPrivate();
    }

    private function canEdit(User $user, User $current_user)
    {
        return $current_user === $user;
    }
}