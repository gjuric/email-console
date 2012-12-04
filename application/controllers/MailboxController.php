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
use Ccentar\Service\MailboxService;
use Ccentar\Entity\Mailbox;
use Ccentar\Entity\Domain;

/**
 * Mailbox Controller
 *
 * @package     Email Console
 * @subpackage  Controllers
 */
class MailboxController extends Zend_Controller_Action
{
    /**
     * Add Action
     */
    public function addAction()
    {
        $domainId = $this->_getParam('domainId', null);

        if ($this->_hasParam('cancel')) {
            if (is_null($domainId)) {
                $this->_helper->redirector('index', 'domain');
            } else {
                $this->_helper->redirector('mailbox', 'domain', 'default', array('id' => $domainId));
            }

            return;
        }

        $service = new DomainService();

        $domain = $service->get($domainId);
        if (is_null($domain)) {
            throw new \Exception('Invalid domain specified', 404);
        }
        $this->view->domain = $domain;

        $form = $this->getAddForm($domain);

        if ( ! $this->getRequest()->isPost()) {
            $this->view->form = $form;
            return;
        }

        // Add @domain to email so we can validate the form
        $params = $this->getAllParams();
        $submitedValue = $params['email'];
        $params['email'] = $params['email'] . '@' . $domain->getName();

        if ( ! $form->isValid($params)) {
            $form->email->setValue($submitedValue);
            $this->view->form = $form;
            return;
        }

        // Add @domain to email before saving
        $data = $form->getValues();
        $data['email'] = $data['email'] . '@' . $domain->getName();

        try {
            $mailboxService = new MailboxService();
            $mailboxService->add($form->getValues(), $domain);
            $this->_helper->flashMessenger(array('success' => 'Mailbox has been created'));
            $this->_helper->redirector('mailbox', 'domain', 'default', array('id' => $domainId));
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
        // TODO:
    }

    /**
     * Delete Action
     */
    public function deleteAction()
    {
        // TODO:
    }

    /**
     * Get Add Form
     *
     * @param  Domain
     * @return \Form_MailboxAdd
     */
    private function getAddForm($domain)
    {
        $form = new \Form_MailboxAdd();
        $form->email->setAttrib('domain', '@' . $domain->getName());
        $form->domainId->setValue($domain->getId());

        return $form;
    }

    /**
     * Get Edit Form
     *
     * @param Mailbox $mailbox
     * @return \Form_MailboxEdit
     */
    private function getEditForm(Mailbox $mailbox)
    {
        $form = new \Form_MailboxEdit();
        $form->setValues($mailbox);

        return $form;
    }
}
