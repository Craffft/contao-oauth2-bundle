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

namespace Craffft\ContaoOAuth2Bundle\Tests\Security;

use Craffft\ContaoOAuth2Bundle\Security\UserProvider;
use Craffft\ContaoOAuth2Bundle\Tests\Setup\AbstractInMemoryTestSetup;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProviderTest extends AbstractInMemoryTestSetup
{
    /**
     * @var UserProvider
     */
    private $userProvider;

    public function setUp()
    {
        parent::setUp();

        $this->userProvider = new UserProvider($this->em);
    }

    public function testLoadUserByUsername()
    {
        $member = $this->userProvider->loadUserByUsername('johndoe');
        $this->assertInstanceOf('Craffft\\ContaoOAuth2Bundle\\Entity\\Member', $member);
    }

    public function testSupportsClass()
    {
        $isSupportingClass = $this->userProvider->supportsClass('Craffft\\ContaoOAuth2Bundle\\Entity\\Member');
        $this->assertTrue($isSupportingClass);
    }

    public function testRefreshUser()
    {
        $member = $this->userProvider->loadUserByUsername('johndoe');

        try {
            $this->userProvider->refreshUser($member);
        } catch (UnsupportedUserException $e) {
            $this->assertEquals(0, $e->getCode());
            return;
        }

        $this->fail('Expected Exception has not been raised.');
    }
}
