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
 * Mailbox Add Form
 *
 * @package     Email Console
 * @subpackage  Forms
 */
class Form_MailboxAdd extends EasyBib_Form
{
    public function init()
    {
        // create elements
        $email      = new Zend_Form_Element_Text('email');
        $name       = new Zend_Form_Element_Text('name');
        $password   = new Zend_Form_Element_Text('password');
        $domainId   = new Zend_Form_Element_Hidden('domainId');
        $active      = new Zend_Form_Element_Radio('active');

        $submit     = new Zend_Form_Element_Submit('submit');
        $cancel     = new Zend_Form_Element_Submit('cancel');

        // config elements
        $email->setLabel('Email')
            ->addValidator('EmailAddress')
            ->setRequired(true)
            ->addFilter('StringTrim');

        $name->setLabel('Name')
            ->setRequired(false)
            ->addFilter('StringTrim');

        $password->setLabel('Password')
            ->setRequired(true);

        $active->setLabel('Active')
            ->setMultiOptions(array('0' => PHP_EOL . 'No', '1' => PHP_EOL . 'Yes'))
            ->setRequired(true)
            ->setValue('1');

        $submit->setLabel('Save');
        $cancel->setLabel('Cancel');

        // add elements
        $this->addElements(array(
            $email, $name, $password, $active, $domainId, $submit, $cancel
        ));

        // add display group
        $this->addDisplayGroup(
            array('email', 'name', 'password', 'active', 'submit', 'cancel'),
            'mailboxAdd'
        );

        $this->setDecorators(array(array(
            'ViewScript', array('viewScript' => '_forms/mailbox_add.phtml')
        )));
    }
}
