<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Ccentar\Entity\Domain;

/**
 * Domain Edit Form
 *
 * @package     Email Console
 * @subpackage  Forms
 */
class Form_DomainEdit extends Form_DomainAdd
{
    public function init()
    {
        parent::init();

        $domainId = new Zend_Form_Element_Hidden('id');
        $this->addElement($domainId);

        // set decorators
        EasyBib_Form_Decorator::setFormDecorator($this, EasyBib_Form_Decorator::BOOTSTRAP, 'submit', 'cancel');
    }

    /**
     * Set Values
     *
     * @param Domain $domain
     */
    public function setValues($domain)
    {
        $this->id->setValue($domain->getId());
        $this->domain->setValue($domain->getName());
        $this->aliases_num->setValue($domain->getNumOfAliases());
        $this->mailboxes_num->setValue($domain->getNumOfMailboxes());
        $this->active->setValue($domain->isActive());
        $this->backup_mx->setValue($domain->isBackup());
    }
}
