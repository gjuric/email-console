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
 * Delivery Status View Helper
 *
 * @package     Email Console
 * @subpackage  View_Helpers
 */
class Zend_View_Helper_DeliveryStatus extends Zend_View_Helper_Abstract
{
    /**
     * Render delivery status
     *
     * @param char $type
     * @return string
     */
    public function deliveryStatus($type)
    {
        switch ($type) {
            case 'P':
                return '<span class="label label-success">Pass</span>';
                break;
            case 'R':
                return '<span class="label label-important">Reject</span>';
                break;
            case 'B':
                return '<span class="label label-important">Bouncer</span>';
                break;
            case 'D':
                return '<span class="label label-important">Discard</span>';
                break;
            case 'T':
                return '<span class="label label-important">Temp. fail</span>';
                break;
            default:
                return $type;
                break;
        }
    }
}
