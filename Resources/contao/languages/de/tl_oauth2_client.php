<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_oauth2_client']['login_legend'] = 'Authentifizierung';
$GLOBALS['TL_LANG']['tl_oauth2_client']['redirect_legend'] = 'Weiterleitungen';
$GLOBALS['TL_LANG']['tl_oauth2_client']['info_legend'] = 'Erstellt / Aktualisiert';
$GLOBALS['TL_LANG']['tl_oauth2_client']['account_legend'] = 'Konto-Einstellungen';

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_oauth2_client']['id'] = array('ID');
$GLOBALS['TL_LANG']['tl_oauth2_client']['client_id'] = array('Client ID');
$GLOBALS['TL_LANG']['tl_oauth2_client']['random_id'] = array('Zufällige ID', 'Bitte geben Sie eine zufällige ID ein oder Sie lassen dieses Feld leer, um die zufällige ID automatisch zu generieren.');
$GLOBALS['TL_LANG']['tl_oauth2_client']['secret'] = array('Secret', 'Bitte geben Sie einen Secret Token ein oder Sie lassen dieses Feld leer, um den Secret automatisch zu generieren.');
$GLOBALS['TL_LANG']['tl_oauth2_client']['allowed_grant_types'] = array('Erlaubte Zugangsarten', 'Bitte wählen Sie die gewünschte Zugangsart für den Client aus.');
$GLOBALS['TL_LANG']['tl_oauth2_client']['redirect_uris'] = array('Weiterleitungen', 'Die Weiterleitungs URLs des Clients.');
$GLOBALS['TL_LANG']['tl_oauth2_client']['created_at'] = array('Erstellt am', 'Datum an dem der Client erstellt wurde.');
$GLOBALS['TL_LANG']['tl_oauth2_client']['updated_at'] = array('Aktualisiert am', 'Datum an dem der Client zuletzt aktualisiert wurde.');
$GLOBALS['TL_LANG']['tl_oauth2_client']['disable'] = array('Deaktivieren', 'Den Client vorübergehend deaktivieren.');
$GLOBALS['TL_LANG']['tl_oauth2_client']['start'] = array('Aktivieren am', 'Den Client automatisch an diesem Tag aktivieren.');
$GLOBALS['TL_LANG']['tl_oauth2_client']['stop'] = array('Deaktivieren am', 'Den Client automatisch an diesem Tag deaktivieren.');

$GLOBALS['TL_LANG']['tl_oauth2_client']['new'] = array('Neuer OAuth2 Client', 'Einen neuen OAuth2 Client anlegen');
$GLOBALS['TL_LANG']['tl_oauth2_client']['show'] = array('OAuth2 Client Details', 'Details des OAuth2 Client ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_oauth2_client']['edit'] = array('OAuth2 Client bearbeiten', 'OAuth2 Client ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_oauth2_client']['delete'] = array('OAuth2 Client löschen', 'OAuth2 Client ID %s löschen');
$GLOBALS['TL_LANG']['tl_oauth2_client']['toggle'] = array('OAuth2 Client aktivieren/deaktivieren', 'OAuth2 Client ID %s aktivieren/deaktivieren');
