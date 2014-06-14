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
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="State")
     *
     * @var State
     */
    private $target;

    /**
     * @ORM\ManyToOne(targetEntity="State", inversedBy="transitions")
     *
     * @var State
     */
    private $state;

    /**
     * @param State $state
     */
    public function __construct(State &$state)
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
