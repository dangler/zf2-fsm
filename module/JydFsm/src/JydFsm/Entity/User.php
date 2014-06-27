<?php

namespace JydFsm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class User
 *
 * @package JydFsm\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $middleName;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="user")
     * @var ArrayCollection
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }
}
