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
 * @ORM\Entity(repositoryClass="Ccentar\Entity\Repository\MailboxRepository")
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
     * @ORM\Column(type="string", length=255, nullable=true)
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
        $this->created_at = $this->modified_at = new \DateTime("now");
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
     * Get Username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set Username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;

        list($local, $domain) = explode('@', $username);
        $this->local_part = $local;

        $this->maildir = '/' . $domain . '/' . $local;
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
     * Set Domain
     *
     * @param Domain $domain
     */
    public function setDomain(Domain $domain)
    {
        $this->domain = $domain;
    }

    /**
     * Set valus from array
     *
     * @param array $data
     */
    public function fromArray($data)
    {
        $this->setUsername($data['email']);
        $this->name     = $data['name'];
        if (!empty($data['password'])) {
            $this->password = $data['password'];
        }

        $this->active = $data['active'];
    }
}
