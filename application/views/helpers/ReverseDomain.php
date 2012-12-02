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
 * ReverseDomainView Helper
 *
 * @package     Email Console
 * @subpackage  View_Helpers
 */
class Zend_View_Helper_ReverseDomain extends Zend_View_Helper_Abstract
{
    /**
     * Reverse Domain
     *
     * @param char $type
     * @return string
     */
    public function reverseDomain($domain)
    {
        return implode(".", array_reverse(explode('.', $domain)));
    }
}
