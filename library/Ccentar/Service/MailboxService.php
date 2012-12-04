<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ccentar\Service;

use Ccentar\Entity\Domain;
use Ccentar\Entity\User;
use Ccentar\Entity\Mailbox;
use Doctrine\ORM\EntityManager;

/**
 * Mailbox Service
 *
 * @package     Email Console
 * @subpackage  Service
 */
class MailboxService
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Service constructor
     *
     * @param EntityManager $em
     */
    public function __construct($em = null)
    {
        if (is_null($em)) {
            $this->em = \Zend_Registry::get('doctrine')->getEntityManager();
        } else {
            $this->em = $em;
        }
    }

    /**
     * Get Entity Manager
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }

    /**
     * Get Repository
     *
     * @return \Ccentar\Entity\Repository\MailboxRepository
     */
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository('\Ccentar\Entity\Mailbox');
    }

    /**
     * Add Mailbox
     *
     * @param array $data
     * @param Domain $domain
     * @return Mailbox
     */
    public function add($data, Domain $domain)
    {
        $mailbox = new Mailbox();
        $mailbox->fromArray($data);
        $mailbox->setDomain($domain);
        $this->getRepository()->save($mailbox);

        return $mailbox;
    }
}
