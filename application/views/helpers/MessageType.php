<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Message Type View Helper
 *
 * @package     Email Console
 * @subpackage  View_Helpers
 */
class Zend_View_Helper_MessageType extends Zend_View_Helper_Abstract
{
    /**
     * Render message type
     *
     * @param char $type
     * @return string
     */
    public function messageType($type)
    {
        switch ($type) {
            case 'S':
                return '<span class="label label-important">Spam</span>';
                break;
            case 's':
                return '<span class="label label-warning">Spam</span>';
                break;
            case 'H':
                return '<span class="label label-info">Bad header</span>';
                break;
            case 'C':
                return '<span class="label label-success">Clean</span>';
                break;

            default:
                return $type;
                break;
        }
    }
}
