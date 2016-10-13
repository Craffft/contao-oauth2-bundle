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

namespace Tests\Craffft\ContaoOAuth2Bundle;

use Craffft\ContaoOAuth2Bundle\CraffftContaoOAuth2Bundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CraffftContaoOAuth2BundleTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
        $bundle = new CraffftContaoOAuth2Bundle();
        $this->assertInstanceOf('Craffft\ContaoOAuth2Bundle\CraffftContaoOAuth2Bundle', $bundle);
    }
}
