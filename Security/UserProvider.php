<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\ContaoOAuth2Bundle\Security;

use Craffft\ContaoOAuth2Bundle\Entity\Member;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
    private $em;
    private $memberEntity;

    public function __construct(EntityManager $entityManager, $memberEntity)
    {
        $this->em = $entityManager;
        $this->memberEntity = $memberEntity;
    }

    public function loadUserByUsername($username)
    {
        $userRepository = $this->em->getRepository($this->memberEntity);

        return $userRepository->findOneByUsername($username);
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return class_exists($this->memberEntity) && $this->memberEntity === $class;
    }
}
