<?php

/**
 * This file is part of the Email Console application.
 *
 * (c) Goran Jurić <goran@ccentar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ccentar\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Domain Entity
 *
 * @package     Email Console
 * @subpackage  Entity
 *
 * @ORM\Entity(repositoryClass="Ccentar\Entity\Repository\DomainRepository")
 * @ORM\Table(name="domain")
 */
class Domain
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $aliases_num;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $mailboxes_num;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    protected $backup_mx;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected $modified_at;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    protected $active;

    /**
     * @ORM\OneToMany(targetEntity="Mailbox", fetch="EXTRA_LAZY", mappedBy="domain")
     * @var type
     */
    protected $mailboxes;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="domains")
     */
    protected $users;

    /**
     * Entity Constructor
     */
    public function __construct()
    {
        $this->mailboxes = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->created_at = new \DateTime("now");
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Is Active
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    public function getNumOfAliases()
    {
        return $this->aliases_num;
    }

    public function getNumOfMailboxes()
    {
        return $this->mailboxes_num;
    }

    public function isBackup()
    {
        return $this->backup_mx;
    }

    /**
     * Add User
     *
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
    }
}
