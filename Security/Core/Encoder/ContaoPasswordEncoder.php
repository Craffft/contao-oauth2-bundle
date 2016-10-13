<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\ContaoOAuth2Bundle\Security\Core\Encoder;

use Contao\Encryption;
use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class ContaoPasswordEncoder extends BasePasswordEncoder
{
    /**
     * {@inheritdoc}
     */
    public function encodePassword($raw, $salt)
    {
        if ($this->isPasswordTooLong($raw)) {
            throw new BadCredentialsException('Invalid password.');
        }

        $strPassword = $raw;
        $intCost = 10;

        if ($intCost < 4 || $intCost > 31)
        {
            throw new \Exception("The bcrypt cost has to be between 4 and 31, $intCost given");
        }

        if (function_exists('password_hash'))
        {
            return password_hash($strPassword, PASSWORD_BCRYPT, array('cost'=>$intCost));
        }
        elseif (CRYPT_BLOWFISH == 1)
        {
            return crypt($strPassword, '$2y$' . sprintf('%02d', $intCost) . '$' . md5(uniqid(mt_rand(), true)) . '$');
        }
        elseif (CRYPT_SHA512 == 1)
        {
            return crypt($strPassword, '$6$' . md5(uniqid(mt_rand(), true)) . '$');
        }
        elseif (CRYPT_SHA256 == 1)
        {
            return crypt($strPassword, '$5$' . md5(uniqid(mt_rand(), true)) . '$');
        }

        throw new \Exception('None of the required crypt() algorithms is available');
    }

    /**
     * {@inheritdoc}
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        if ($this->isPasswordTooLong($raw)) {
            return false;
        }

        if (Encryption::test($encoded)) {
            return Encryption::verify($raw, $encoded);
        } else {
            list($strPassword, $strSalt) = explode(':', $encoded);

            return ($strSalt == '') ? ($strPassword === sha1($raw)) : ($strPassword === sha1($strSalt . $raw));
        }
    }
}
