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
 * Domain Add Form
 *
 * @package     Email Console
 * @subpackage  Forms
 */
class Form_DomainAdd extends EasyBib_Form
{
    public function init()
    {
        // create elements
        $domain      = new Zend_Form_Element_Text('domain');
        $aliases     = new Zend_Form_Element_Text('aliases_num');
        $mailboxes   = new Zend_Form_Element_Text('mailboxes_num');
        $backup_mx   = new Zend_Form_Element_Radio('backup_mx');
        $active      = new Zend_Form_Element_Radio('active');
        $submit      = new Zend_Form_Element_Submit('submit');
        $cancel      = new Zend_Form_Element_Submit('cancel');

        // config elements

        $domain->setLabel('Domain')
            ->addValidator('Hostname')
            ->setRequired(true)
            ->addFilter('StringTrim');

        $aliases->setLabel('Aliases #')
            ->setRequired(true)
            ->addValidator('Digits')
            ->setDescription('Allowed number of aliases.')
            ->setValue('0');

        $mailboxes->setLabel('Mailboxes #')
            ->setRequired(true)
            ->addValidator('Digits')
            ->setDescription('Allowed number of mailboxes.')
            ->setValue('0');

        $backup_mx->setLabel('Backup MX')
            ->setMultiOptions(array('0' => PHP_EOL . 'No', '1' => PHP_EOL . 'Yes'))
            ->setRequired(true)
            ->setValue('0');

        $active->setLabel('Active')
            ->setMultiOptions(array('0' => PHP_EOL . 'No', '1' => PHP_EOL . 'Yes'))
            ->setRequired(true)
            ->setValue('1');

        $submit->setLabel('Save');
        $cancel->setLabel('Cancel');

        // add elements
        $this->addElements(array(
            $domain, $aliases, $mailboxes, $backup_mx, $active, $submit, $cancel
        ));

        // add display group
        $this->addDisplayGroup(
            array('domain', 'aliases_num', 'mailboxes_num', 'backup_mx', 'active', 'submit', 'cancel'),
            'domainInfo'
        );

        // set decorators
        EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'submit', 'cancel');
    }
}
