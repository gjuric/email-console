<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Ccentar\Service\AmavisService;

/**
 * Index Controller
 *
 * @package     Email Console
 * @subpackage  Controllers
 */
class ReportController extends Zend_Controller_Action
{
    /**
     * Index Action
     *
     * View latest emails that went through the system.
     */
    public function indexAction()
    {
        $service = new AmavisService();
        $page = $this->_getParam('page', 1);
        $this->view->latest = $service->getLatest($page);
        $this->view->paginator = $service->getLatestPaginator($page);
    }

    /**
     * Spam Action
     *
     * View emails with highest SPAM score.
     */
    public function spamAction()
    {
        $service = new AmavisService();
        $this->view->messages = $service->topSpam();
    }

    /**
     * Ham Action
     *
     * View emails with lowest SPAM score.
     */
    public function hamAction()
    {
        $service = new AmavisService();
        $this->view->messages = $service->topHam();
    }

    public function sendersAction()
    {
        $service = new AmavisService();
        $this->view->messages = $service->topSenders();
    }
}
