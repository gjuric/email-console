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
 * FlashMessages View Helper
 *
 * Displays flash messages from this and the previous request. Clears
 * messages after displaying them for the first time.
 *
 * @package     Email Console
 * @subpackage  View_Helpers
 */
class Zend_View_Helper_FlashMessages extends \Zend_View_Helper_Abstract
{
    /**
     * @var Zend_Controller_Action_Helper_FlashMessenger
     */
    private $_flashMessenger = null;

    /**
     * Display Flash Messages.
     *
     * @param  string $key Message level for string messages
     * @param  string $template Format string for message output
     * @return string Flash messages formatted for output
     */
    public function flashMessages($key = 'info', $template='<div class="alert alert-%s">%s</div>')
    {
        $flashMessenger = $this->_getFlashMessenger();

        // Get messages from previous requests
        $messages = $flashMessenger->getMessages();

        // Add any messages from this request
        if ($flashMessenger->hasCurrentMessages()) {
            $messages = array_merge(
                $messages,
                $flashMessenger->getCurrentMessages()
            );
            //we don't need to display them twice.
            $flashMessenger->clearCurrentMessages();
        }

        // We do not want to display the same message twice
        $flashMessenger->clearMessages();

        $output ='';

        // Process messages
        foreach ($messages as $message)
        {
            if (is_array($message)) {
                list($key, $message) = each($message);
            }
            $output .= sprintf($template, $key, $message);
        }

        return $output;
    }

    /**
     * Laizy load FlashMessenger Instance.
     *
     * @return Zend_Controller_Action_Helper_FlashMessenger
     */
    public function _getFlashMessenger()
    {
        if (null === $this->_flashMessenger) {
            $this->_flashMessenger =
                Zend_Controller_Action_HelperBroker::getStaticHelper(
                    'FlashMessenger');
        }
        return $this->_flashMessenger;
    }
}
