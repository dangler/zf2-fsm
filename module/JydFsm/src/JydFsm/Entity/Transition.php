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
     * @param State $state state it belongs to
     * @param State $target state it will transition to if executed
     */
    public function __construct(State $state, State $target)
    {
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
     *
     */
    public function execute()
    {
        // collects all guard check results
        $guardResults = $this->guards->map(
            function($guard){
                /** @var Guard $guard */
                return $guard->check();
            });

        // if guardResults is not empty, check is any guard failed
        $guardResultPredicate = function($guardResult) {
            /** @var Result $guardResult */
            if ($guardResult) {
                return $guardResult->getResult();
            }
        };

        // if any guards failed then return and don't execute actions
        if (count($guardResults) && $guardResults->forAll($guardResultPredicate)) {
            return $guardResults;
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
