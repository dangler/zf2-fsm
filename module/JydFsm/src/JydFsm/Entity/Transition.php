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
     * @ORM\OneToMany(targetEntity="Action", mappedBy="transition")
     *
     * @var ArrayCollection
     */
    private $actions;

    /**
     * @param State $state
     * @param State $target
     */
    public function __construct(State $state, State $target)
    {
        $this->state = $state;
        $this->target = $target;
        $this->actions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return State
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @return State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * When executed set the target state as current in the machine
     */
    public function execute()
    {
        $this->target->setSelfAsCurrent();
    }

    /**
     * @return bool
     */
    public function hasActions()
    {
        return !$this->actions->isEmpty();
    }

    /**
     * @param Action
     */
    public function addAction(Action $action)
    {
        $this->actions->add($action);
    }
}
