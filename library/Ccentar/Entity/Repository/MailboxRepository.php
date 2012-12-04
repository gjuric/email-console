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
use Ccentar\Entity\Mailbox;

/**
 * Mailbox Repository
 *
 * @package     Email Console
 * @subpackage  Repository
 */
class MailboxRepository extends EntityRepository
{
    /**
     * Save
     *
     * @param Mailbox $mailbox
     */
    public function save(Mailbox $mailbox)
    {
        $this->getEntityManager()->persist($mailbox);
        $this->getEntityManager()->flush();
    }
}
