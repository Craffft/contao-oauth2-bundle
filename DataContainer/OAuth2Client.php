<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\ContaoOAuth2Bundle\DataContainer;

use Contao\Backend;
use Contao\CoreBundle\Exception\AccessDeniedException;
use Contao\DataContainer;
use Contao\Image;
use Contao\Input;
use Contao\Versions;

class OAuth2Client extends Backend
{
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * @param $dc
     */
    public function storeCreatedAtAndUpdatedAt($dc)
    {
        // Front end call
        if (!$dc instanceof DataContainer) {
            return;
        }

        // Return if there is no active record (override all)
        if (!$dc->activeRecord) {
            return;
        }

        $datetime = new \DateTime();
        $formattedDatetime = $datetime->format(\DateTime::ISO8601);

        if ($dc->activeRecord->created_at <= 0) {
            $this->Database->prepare("UPDATE tl_oauth2_client SET created_at=?, updated_at=? WHERE id=?")
                ->execute($formattedDatetime, $formattedDatetime, $dc->id);
        } else {
            $this->Database->prepare("UPDATE tl_oauth2_client SET updated_at=? WHERE id=?")
                ->execute($formattedDatetime, $dc->id);
        }
    }

    /**
     * @param $row
     * @param $label
     * @param DataContainer $dc
     * @param $args
     * @return array
     */
    public function prepareRowItems($row, $label, DataContainer $dc, $args)
    {
        $args[0] = $row['id'] . '_' . $row['random_id'];

        $secret = $row['secret'];

        if (strlen($secret)) {
            $arrSpliters = str_split($secret, 32);
            $args[1] = implode('<br>', $arrSpliters);
        }

        $allowedGrantTypes = deserialize($row['allowed_grant_types']);

        if (is_array($allowedGrantTypes)) {
            $args[2] = implode('<br>', $allowedGrantTypes);
        }

        return (array)$args;
    }

    /**
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (strlen(Input::get('tid'))) {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->hasAccess('tl_oauth2_client::disable', 'alexf')) {
            return '';
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . $row['disable'];

        if ($row['disable']) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon,
            $label, 'data-state="' . ($row['disable'] ? 0 : 1) . '"') . '</a> ';
    }

    /**
     * @param $intId
     * @param $blnVisible
     * @param DataContainer|null $dc
     */
    public function toggleVisibility($intId, $blnVisible, DataContainer $dc = null)
    {
        // Set the ID and action
        Input::setGet('id', $intId);
        Input::setGet('act', 'toggle');

        if ($dc) {
            $dc->id = $intId; // see #8043
        }

        // Check the field access
        if (!$this->User->hasAccess('tl_oauth2_client::disable', 'alexf')) {
            throw new AccessDeniedException('Not enough permissions to activate/deactivate member ID ' . $intId . '.');
        }

        $objVersions = new Versions('tl_oauth2_client', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_oauth2_client']['fields']['disable']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_oauth2_client']['fields']['disable']['save_callback'] as $callback) {
                if (is_array($callback)) {
                    $this->import($callback[0]);
                    $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, ($dc ?: $this));
                } elseif (is_callable($callback)) {
                    $blnVisible = $callback($blnVisible, ($dc ?: $this));
                }
            }
        }

        $time = time();

        // Update the database
        $this->Database->prepare("UPDATE tl_oauth2_client SET tstamp=$time, disable='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
            ->execute($intId);

        $objVersions->create();
        $this->log('A new version of record "tl_oauth2_client.id=' . $intId . '" has been created' . $this->getParentEntries('tl_oauth2_client',
                $intId), __METHOD__, TL_GENERAL);
    }

    /**
     * @param $varValue
     * @param DataContainer $dc
     * @return string
     */
    public function setDefaultRandomId($varValue, DataContainer $dc)
    {
        if (empty($varValue)) {
            $varValue = str_pad(rand(1, 99999999), 8, 0, STR_PAD_LEFT);
        }

        return $varValue;
    }

    /**
     * @param $varValue
     * @param DataContainer $dc
     * @return string
     */
    public function setDefaultSecret($varValue, DataContainer $dc)
    {
        if (empty($varValue)) {
            $varValue = substr(preg_replace('/[^A-Za-z0-9]/', '', base64_encode(random_bytes(128))), 0, 128);
        }

        return $varValue;
    }
}
