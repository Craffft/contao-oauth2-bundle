<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_oauth2_client'] = array
(
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'onsubmit_callback' => array
        (
            array('Craffft\\ContaoOAuth2Bundle\\DataContainer\\OAuth2Client', 'storeCreatedAtAndUpdatedAt')
        ),
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 2,
            'fields'                  => array('updated_at DESC'),
            'flag'                    => 1,
            'panelLayout'             => 'filter;sort,search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('client_id', 'secret', 'allowed_grant_types'),
            'showColumns'             => true,
            'label_callback'          => array('Craffft\\ContaoOAuth2Bundle\\DataContainer\\OAuth2Client', 'prepareRowItems')
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_oauth2_client']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_oauth2_client']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_oauth2_client']['toggle'],
                'icon'                => 'visible.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('Craffft\\ContaoOAuth2Bundle\\DataContainer\\OAuth2Client', 'toggleIcon')
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_oauth2_client']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__'                => array('login', 'assignDir'),
        'default'                     => '{login_legend},random_id,secret,allowed_grant_types;{redirect_legend:hide},redirect_uris;{info_legend:hide},created_at,updated_at;{account_legend},disable,start,stop',
    ),


    // Fields
    'fields' => array
    (
        'id' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['id'],
            'search'                  => true,
            'sorting'                 => true,
            'sql'                     => "int(11) NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'client_id' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['client_id']
        ),
        'random_id' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['random_id'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('unique'=>true, 'rgxp'=>'extnd', 'nospace'=>true, 'maxlength'=>64),
            'load_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\DataContainer\\OAuth2Client', 'setDefaultRandomId')
            ),
            'sql'                     => "varchar(255) NOT NULL"
        ),
        'secret' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['secret'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => array('rgxp'=>'extnd', 'nospace'=>true, 'preserveTags'=>true, 'minlength'=>32, 'tl_class' => 'long'),
            'load_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\DataContainer\\OAuth2Client', 'setDefaultSecret')
            ),
            'sql'                     => "varchar(255) NOT NULL"
        ),
        'allowed_grant_types' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['allowed_grant_types'],
            'exclude'                 => true,
            'default'                 => array(
                \Craffft\ContaoOAuth2Bundle\OAuth2\OAuth2::GRANT_TYPE_AUTH_CODE,
                \Craffft\ContaoOAuth2Bundle\OAuth2\OAuth2::GRANT_TYPE_USER_CREDENTIALS
            ),
            'inputType'               => 'checkbox',
            'options_callback'        => function() {
                return \Craffft\ContaoOAuth2Bundle\OAuth2\OAuth2::getGrantTypes();
            },
            'eval'                    => array('multiple'=>true),
            'sql'                     => "longtext NOT NULL"
        ),
        'redirect_uris' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['redirect_uris'],
            'exclude'                 => true,
            'sql'                     => "longtext NOT NULL",
            'inputType'               => 'multiColumnWizard',
            'eval'                    => array
            (
                'columnFields' => array
                (
                    array
                    (
                        'label'         => ' ',
                        'inputType'     => 'text'
                    )
                )
            )
        ),
        'created_at' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['created_at'],
            'exclude'                 => true,
            'sorting'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('disabled'=>true, 'rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "datetime NOT NULL",
            'load_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\Util\\DateConverter', 'getTimestampFromDateString')
            ),
            'save_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\Util\\DateConverter', 'getDateStringFromTimestamp')
            )
        ),
        'updated_at' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['updated_at'],
            'exclude'                 => true,
            'sorting'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('disabled'=>true, 'rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "datetime NOT NULL",
            'load_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\Util\\DateConverter', 'getTimestampFromDateString')
            ),
            'save_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\Util\\DateConverter', 'getDateStringFromTimestamp')
            )
        ),
        'disable' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['disable'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'sql'                     => "tinyint(1) NOT NULL"
        ),
        'start' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['start'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "datetime NULL",
            'load_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\Util\\DateConverter', 'getTimestampFromDateString')
            ),
            'save_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\Util\\DateConverter', 'getDateStringFromTimestamp')
            )
        ),
        'stop' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_oauth2_client']['stop'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "datetime NULL",
            'load_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\Util\\DateConverter', 'getTimestampFromDateString')
            ),
            'save_callback' => array
            (
                array('Craffft\\ContaoOAuth2Bundle\\Util\\DateConverter', 'getDateStringFromTimestamp')
            )
        )
    )
);
