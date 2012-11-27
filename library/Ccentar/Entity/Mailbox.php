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

/**
 * Mailbox Entity
 *
 * @package     Email Console
 * @subpackage  Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="mailbox")
 */
class Mailbox
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
    protected $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $local_part;

    /**
     * @ORM\ManyToOne(targetEntity="Domain")
     * @var Domain
     */
    protected $domain;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $maildir;

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
     * Entity Constructor
     */
    public function __construct()
    {
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
     * Is Active
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set Domain
     * 
     * @param Domain $domain
     */
    public function setDomain(Domain $domain)
    {
        $this->domain = $domain;
    }
}
