<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\ContaoOAuth2Bundle\Util;

class DateConverter
{
    public function getTimestampFromDateString($dateString)
    {
        if (empty($dateString)) {
            $timestamp = null;
        } elseif (is_string($dateString)) {
            $timestamp = strtotime($dateString);
        } else {
            $timestamp = $dateString;
        }

        return $timestamp;
    }

    public function getDateStringFromTimestamp($timestamp)
    {
        if (empty($timestamp)) {
            $dateString = null;
        } elseif (is_numeric($timestamp)) {
            // 2016-07-09 10:30:00
            $dateString = date('Y-m-d H:i:s', $timestamp);
        } else {
            $dateString = $timestamp;
        }

        return $dateString;
    }
}
