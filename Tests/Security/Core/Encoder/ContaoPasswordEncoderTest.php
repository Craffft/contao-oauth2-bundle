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

namespace Tests\Craffft\ContaoOAuth2Bundle\Security\Core\Encoder;

use Craffft\ContaoOAuth2Bundle\Security\Core\Encoder\ContaoPasswordEncoder;

class ContaoPasswordEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testEncodePassword()
    {
        $contaoPasswordEncoder = new ContaoPasswordEncoder();

        $encoded = $contaoPasswordEncoder->encodePassword('Pa$$word', '12345SALT67890');
        $this->assertStringStartsWith('$2y$10$', $encoded);
    }

    public function testIsPasswordValid()
    {
        $contaoPasswordEncoder = new ContaoPasswordEncoder();

        $rawPassword = 'Pa$$word';
        $salt = '12345SALT67890';

        $encoded = $contaoPasswordEncoder->encodePassword($rawPassword, $salt);
        $this->assertTrue($contaoPasswordEncoder->isPasswordValid($encoded, $rawPassword, $salt));
    }
}
