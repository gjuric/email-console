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
 * User Entity
 *
 * @package     Email Console
 * @subpackage  Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
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
     * @ORM\ManyToMany(targetEntity="Domain", inversedBy="users")
     * @ORM\JoinTable(name="users_domains")
     */
    protected $domains;

    /**
     * Entity Constructor
     */
    public function __construct()
    {
        $this->created_at = new \DateTime("now");
        $this->domains = new ArrayCollection();
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
     * Add Domain
     *
     * @param Domain $domain
     */
    public function addDomain(Domain $domain)
    {
        $domain->addUser($this);
        $this->domains[] = $domain;
    }
}
