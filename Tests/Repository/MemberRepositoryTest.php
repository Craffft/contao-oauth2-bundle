<?php

/*
 * This file is part of the Craffft Contao OAuth2 Bundle.
 *
 * (c) Craffft <https://craffft.de>
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Craffft\ContaoOAuth2Bundle\Repository;

use Craffft\ContaoOAuth2Bundle\Entity\Member;
use Craffft\ContaoOAuth2Bundle\Tests\Setup\AbstractInMemoryTestSetup;

class MemberRepositoryTest extends AbstractInMemoryTestSetup
{
    public function testFindOneByUsername()
    {
        /** @var Member $member */
        $member = $this->em
            ->getRepository('CraffftContaoOAuth2Bundle:Member')
            ->findOneByUsername('johndoe');

        $this->assertInstanceOf(Member::class, $member);
        $this->assertEquals('John', $member->getFirstname());
        $this->assertEquals('Doe', $member->getLastname());

        /** @var Member $member */
        $member = $this->em
            ->getRepository('CraffftContaoOAuth2Bundle:Member')
            ->findOneByUsername('johndoe_disabled');

        $this->assertNull($member);

        /** @var Member $member */
        $member = $this->em
            ->getRepository('CraffftContaoOAuth2Bundle:Member')
            ->findOneByUsername('johndoe_start_available');

        $this->assertInstanceOf(Member::class, $member);

        /** @var Member $member */
        $member = $this->em
            ->getRepository('CraffftContaoOAuth2Bundle:Member')
            ->findOneByUsername('johndoe_start_restricted');

        $this->assertNull($member);

        /** @var Member $member */
        $member = $this->em
            ->getRepository('CraffftContaoOAuth2Bundle:Member')
            ->findOneByUsername('johndoe_stop_available');

        $this->assertInstanceOf(Member::class, $member);

        /** @var Member $member */
        $member = $this->em
            ->getRepository('CraffftContaoOAuth2Bundle:Member')
            ->findOneByUsername('johndoe_stop_restricted');

        $this->assertNull($member);
    }
}
