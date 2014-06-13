<?php

namespace JydFsm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JydFsm\Entity\State;

/**
 * Class Transition
 * @package JydFsm\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="transition")
 */
class Transition
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\OneToOne(targetEntity="State")
     *
     * @var State
     */
    protected $target;

    /**
     * @param State $state
     */
    public function __construct(State $state)
    {
        $this->target = $state;
    }

    /**
     * @return State
     */
    public function getTarget()
    {
        return $this->target;
    }
}
