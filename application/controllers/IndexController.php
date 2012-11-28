<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Ccentar\Service\DomainService;

/**
 * Index Controller
 *
 * @package     Email Console
 * @subpackage  Controllers
 */
class IndexController extends \Zend_Controller_Action
{
    /**
     * Index Action
     */
    public function indexAction()
    {
        $this->_forward('index', 'domain');
    }
}
