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

namespace Craffft\ContaoOAuth2Bundle\Tests;

use Craffft\ContaoOAuth2Bundle\CraffftContaoOAuth2Bundle;

class CraffftContaoOAuth2BundleTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
        $bundle = new CraffftContaoOAuth2Bundle();
        $this->assertInstanceOf('Craffft\ContaoOAuth2Bundle\CraffftContaoOAuth2Bundle', $bundle);
    }
}
