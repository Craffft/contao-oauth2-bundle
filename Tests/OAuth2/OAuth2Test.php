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

namespace Craffft\ContaoOAuth2Bundle\Tests\OAuth2;

use Craffft\ContaoOAuth2Bundle\OAuth2\OAuth2;

class OAuth2Test extends \PHPUnit_Framework_TestCase
{
    public function testGrantTypes()
    {
        $grantTypes = array(
            'authorization_code',
            'token',
            'password',
            'client_credentials',
            'refresh_token',
            'extensions'
        );

        $this->assertArraySubset($grantTypes, OAuth2::getGrantTypes());
    }
}
