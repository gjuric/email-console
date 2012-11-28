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
use Ccentar\Entity\Domain;

/**
 * Domain Controller
 *
 * @package     Email Console
 * @subpackage  Controllers
 */
class DomainController extends \Zend_Controller_Action
{
    /**
     * Index Action
     */
    public function indexAction()
    {
        $service = new DomainService();
        $this->view->domains = $service->fetchAll();
    }

    /**
     * Add Action
     */
    public function addAction()
    {
        if ($this->_hasParam('cancel')) {
            $this->_helper->redirector('index');
            return;
        }

        $form = $this->getAddForm();

        if ( ! $this->getRequest()->isPost()) {
            $this->view->form = $form;
            return;
        }

        if ( ! $form->isValid($this->getAllParams())) {
            $this->view->form = $form;
            return;
        }

        try {
            $service = new DomainService();
            $service->add($form->getValues());
            $this->_helper->flashMessenger(array('success' => 'Domain has been created'));
            $this->_helper->redirector('index');
        } catch (\Exception $e) {
            $this->_helper->flashMessenger(array('error' => 'An error occurred'));
            $this->view->form = $form;
        }
    }

    /**
     * Edit Action
     */
    public function editAction()
    {
        if ($this->_hasParam('cancel')) {
            $this->_helper->redirector('index');
            return;
        }

        // Use add.phtml to render the form
        $this->_helper->viewRenderer('add');

        $service = new DomainService();
        $domain = $service->get($this->_getParam('id'));

        if (is_null($domain)) {
            $this->_helper->flashMessenger(array('error' => 'Domain does not exist'));
            $this->_helper->redirector('index');
        }

        $form = $this->getEditForm($domain);

        if ( ! $this->getRequest()->isPost()) {
            $this->view->form = $form;
            return;
        }

        if ( ! $form->isValid($this->getAllParams())) {
            $this->view->form = $form;
            return;
        }

        try {
            $service->edit($domain, $form->getValues());
            $this->_helper->flashMessenger(array('success' => 'Domain information has been updated'));
            $this->_helper->redirector('index');
        } catch (\Exception $e) {
            $this->_helper->flashMessenger(array('error' => 'An error occurred'));
            $this->view->form = $form;
        }
    }

    public function deleteAction()
    {
        // TODO:
    }

    /**
     * Get Add Form
     *
     * @return \Form_DomainAdd
     */
    private function getAddForm()
    {
        return new \Form_DomainAdd();
    }

    /**
     * Get Edit Form
     *
     * @param Domain $domain
     * @return \Form_DomainEdit
     */
    private function getEditForm(Domain $domain)
    {
        $form = new \Form_DomainEdit();
        $form->setValues($domain);

        return $form;
    }
}
