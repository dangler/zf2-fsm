<?php
/**
 * Created by PhpStorm.
 * User: jdangler
 * Date: 6/7/2014
 * Time: 10:59 PM
 */

namespace JydFsm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JydFsm\Entity\Action\Action;

/**
 * Class State
 *
 * @package JydFam\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="state")
 */

class State 
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
     * $var string
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Transition", mappedBy="state")
     *
     * @var ArrayCollection
     */
    private $transitions;

    /**
     * @ORM\ManyToOne(targetEntity="Machine", inversedBy="states")
     *
     * @var Machine
     */
    private $machine;

    /**
     * @ORM\OneToMany(targetEntity="JydFsm\Entity\Action\Action", mappedBy="$stateEntry")
     *
     * @var ArrayCollection
     */
    private $onEntryActions;

    /**
     * @ORM\OneToMany(targetEntity="JydFsm\Entity\Action\Action", mappedBy="$stateExit")
     *
     * @var ArrayCollection
     */
    private $onExitActions;

    /**
     *
     */
    public function __construct(Machine $machine) {
        $this->transitions = new ArrayCollection();
        $this->onEntryActions = new ArrayCollection();
        $this->onExitActions = new ArrayCollection();
        $this->machine = $machine;
    }

    /**
     * @return bool
     */
    public function hasInternalStates()
    {
        return !$this->states->isEmpty();
    }

    /**
     * @return bool
     */
    public function hasTransitions()
    {
        return !$this->transitions->isEmpty();
    }

    /**
     * @param Transition
     */
    public function addTransition(Transition $transition)
    {
        $this->transitions->add($transition);
    }

    /**
     * @return Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * Sets the machine's current state to self
     */
    public function setSelfAsCurrent()
    {
        $this->machine->setCurrentState($this);
    }

    /**
     * @param $transitionName
     * @return Transition
     * @throws \Exception
     */
    public function getTransition($transitionName)
    {
        $t = $this->transitions->filter(function($entity) use ($transitionName) {
             return $entity->getName() == $transitionName;
        });

        if ($t->count()) {
            return $t->first();
        }

        throw new \Exception("Transition with name $transitionName was not found");
    }

    /**
     * @return bool
     */
    public function hasOnEntryActions()
    {
        return !$this->onEntryActions->isEmpty();
    }

    /**
     * @param Action $action
     * @return bool
     */
    public function addOnEntryAction(Action $action)
    {
        $this->onEntryActions->add($action);
    }

    /**
     *
     */
    public function invokeOnEntryActions()
    {
        foreach ($this->onEntryActions as $action) {
            $action->invoke();
        }
    }

    /**
     *
     */
    public function invokeOnExitActions()
    {
        foreach ($this->onEntryActions as $action) {
            $action->invoke();
        }
    }

    /**
     * @return bool
     */
    public function hasOnExitActions()
    {
        return !$this->onExitActions->isEmpty();
    }

    /**
     * @param Action $action
     */
    public function addOnExitAction(Action $action)
    {
        $this->onExitActions->add($action);
    }

    /**
     * @return bool
     */
    public function hasParent()
    {
        if ( $this->parent === null)
        {
            return false;
        } else {
            return true;
        }
    }
}
