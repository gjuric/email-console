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
use Doctrine\ORM\EntityManager;

/**
 * Domain Service
 *
 * @package     Email Console
 * @subpackage  Service
 */
class DomainService
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
     * @return \Ccentar\Entity\Repository\DomainRepository
     */
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository('\Ccentar\Entity\Domain');
    }

    /**
     * Fetch All Domains
     *
     * @return array
     */
    public function fetchAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * Get Domain
     *
     * @param integer $id
     * @return Ccentar\Entity\Domain
     */
    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Add a Domain
     *
     * @param array $data
     * @return Domain
     */
    public function add($data)
    {
        $domain = new Domain();
        $domain->fromArray($data);
        $this->getRepository()->save($domain);

        return $domain;
    }

    /**
     * Edit a Domain
     *
     * @param Domain $domain
     * @param array $data
     * @return Domain
     */
    public function edit($domain, $data)
    {
        $domain->fromArray($data);
        $domain->setModifiedAt(new \DateTime("now"));
        $this->getRepository()->save($domain);

        return $domain;
    }
}
