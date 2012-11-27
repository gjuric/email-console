<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ccentar\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Domain Repository
 *
 * @package     Email Console
 * @subpackage  Repository
 */
class DomainRepository extends EntityRepository
{
    /**
     * Save
     *
     * @param Domain $domain
     */
    public function save($domain)
    {
        $this->getEntityManager()->persist($domain);
        $this->getEntityManager()->flush();
    }
}
