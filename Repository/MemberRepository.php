<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\ContaoOAuth2Bundle\Repository;

use Doctrine\ORM\EntityRepository;

class MemberRepository extends EntityRepository
{
    public function findOneByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username')
            ->andWhere('u.disable != 1')
            ->andWhere("u.start <= :tstamp OR u.start = ''")
            ->andWhere("u.stop >= :tstamp OR u.stop = ''")
            ->setParameter('username', $username)
            ->setParameter('tstamp', time())
            ->getQuery()
            ->getOneOrNullResult();
    }
}
