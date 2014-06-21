<?php

namespace JydFsm\Entity\Guard;

use Doctrine\ORM\Mapping as ORM;

use JydFsm\Entity\Transition;

/**
 * Class Guard
 *
 * @package JydFsm\Entity\Guard
 *
 * @ORM\Entity
 * @ORM\Table(name="guard")
 */
abstract class Guard
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
    private $name;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="JydFsm\Entity\Transition", inversedBy="guards")
     *
     * @var Transition
     */
    private $transition;

    /**
     * Checks if the guard has been met
     *
     * @return bool
     */
    abstract public function check();
}
