<?php

namespace JydFsm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JydFsm\Entity\Guard\Guard;
use JydFsm\Entity\Guard\Result;
use JydFsm\Entity\Action\Action;

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
     * @ORM\ManyToOne(targetEntity="Machine", inversedBy="transitions")
     *
     * @var Machine
     */
    private $machine;

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
     * @ORM\OneToMany(targetEntity="JydFsm\Entity\Action\Action", mappedBy="transition")
     *
     * @var ArrayCollection
     */
    private $actions;

    /**
     * @ORM\OneToMany(targetEntity="JydFsm\Entity\Guard\Guard", mappedBy="transition")
     *
     * @var ArrayCollection
     */
    private $guards;

    /**
     * @param Machine $machine machine that transition is in
     * @param State $state state it belongs to
     * @param State $target state it will transition to if executed
     */
    public function __construct(Machine $machine, State $state, State $target)
    {
        $this->machine = $machine;
        $this->state = $state;
        $this->target = $target;
        $this->actions = new ArrayCollection();
        $this->guards = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return bool|ArrayCollection
     */
    public function execute()
    {
        // check the guards, return results if not true
        $result = $this->checkGuards();

        if ($result !== true) {
            return $result;
        }

        // call all on exit actions for the source
        $this->state->invokeOnExitActions();

        // call all the actions
        foreach($this->actions as $action) {
            $action->invoke();
        }

        // call all on entry actions for target
        $this->target->invokeOnEntryActions();

        // update machine to the target state
        $this->machine->setCurrentState($this->target);

        return true;
    }

    /*
     * @return ArrayCollection|boolean
     */
    public function checkGuards()
    {
        // collects all guard check results
        $guardResults = $this->guards->map(
            function($guard){
                /** @var Guard $guard */
                return $guard->check();
            });

        // predicate function for - if guardResults is not empty, check if any guard failed
        $guardResultPredicate = function($key, $guardResult) {
            /** @var Result $guardResult */
            if ($guardResult) {
                return $guardResult->result;
            }
        };

        // if any guards failed then return and don't execute actions
        if (!$guardResults->forAll($guardResultPredicate)) {
            return $guardResults;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function hasActions()
    {
        return !$this->actions->isEmpty();
    }

    /**
     * @param Action $action
     */
    public function addAction(Action $action)
    {
        $this->actions->add($action);
    }

    /**
     * @return bool
     */
    public function hasGuards()
    {
        return !$this->guards->isEmpty();
    }

    /**
     * @param Guard $guard
     */
    public function addGuard(Guard $guard)
    {
        $this->guards->add($guard);
    }
}
