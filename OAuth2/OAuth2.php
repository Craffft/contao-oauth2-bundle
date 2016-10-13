<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\ContaoOAuth2Bundle\OAuth2;

use OAuth2\OAuth2 as BaseOAuth2;

class OAuth2 extends BaseOAuth2
{
    public static function getGrantTypes()
    {
        return array(
            self::GRANT_TYPE_AUTH_CODE,
            self::GRANT_TYPE_IMPLICIT,
            self::GRANT_TYPE_USER_CREDENTIALS,
            self::GRANT_TYPE_CLIENT_CREDENTIALS,
            self::GRANT_TYPE_REFRESH_TOKEN,
            self::GRANT_TYPE_EXTENSIONS
        );
    }
}
