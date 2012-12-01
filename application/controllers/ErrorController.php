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
 * Error Controller
 *
 * Based on the exception the controller responds with a 404 (page not found)
 * or a 500 (internal server error) status code.
 *
 * @package     Email Console
 * @subpackage  Controllers
 */
class ErrorController extends Zend_Controller_Action
{

    /**
     * Error Action
     */
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');

//        if (APPLICATION_ENV === 'development') {
            $this->view->requestParams = $errors->request->getParams();

            // shiny.phtml
            $this->view->request   = $errors->request;
            $this->view->exception = $errors->exception;
            $this->_helper->layout->disableLayout();
            $this->_helper->viewRenderer('shiny');
            return;
//        }


        $this->_helper->layout->setLayout('layout');

        switch ($errors->type) {
            // 404 errors
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);

                $this->view->title = $this->view->translate('Page not found');

                $this->_helper->viewRenderer('404');
                return; // End here
                break;
            default:
                // We are dealing with an application error
                $this->getResponse()->setHttpResponseCode(500);

                $this->view->title = $this->view->translate('Internal error');

                $this->_helper->viewRenderer('500');

                // check for a 404 thrown from the application
                if (method_exists($errors->exception, 'getCode')) {
                    $code = $errors->exception->getCode();
                    if (404 == $code) {
                        $this->getResponse()->setHttpResponseCode(404);
                        $this->_helper->viewRenderer('404');
                    } else {
                        $code = 500;
                        $this->_helper->viewRenderer('404');
                    }

                }

                break;
        }
    }
}
