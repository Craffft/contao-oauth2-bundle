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

namespace Craffft\ContaoOAuth2Bundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;

class CraffftContaoOAuth2ExtensionTest extends WebTestCase
{
    /**
     * @var Container
     */
    private $container;

    public function setUp()
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    public function testServices()
    {
        $this->assertTrue($this->container->has('craffft.contao_oauth2.user_provider'));
        $this->assertTrue($this->container->has('craffft.contao_oauth2.contao_password_encoder'));
    }
}
