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
use JydFsm\Entity\Element\Element;
use PhpSpec\Exception\Exception;

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
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="states")
     *
     * @var Role
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="JydFsm\Entity\Element\Element", mappedBy="state")
     *
     * @var ArrayCollection
     */
    private $elements;

    /**
     * @ORM\OneToMany(targetEntity="Transition", mappedBy="state")
     *
     * @var ArrayCollection
     */
    private $transitions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $defaultTransitionKey;

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
        $this->elements = new ArrayCollection();
        $this->machine = $machine;
    }

    /**
     * @return bool
     */
    public function hasTransitions()
    {
        return !$this->transitions->isEmpty();
    }

    /**
     * @param Transition $transition
     * @param bool $default set as default
     */
    public function addTransition(Transition $transition, $default = false)
    {
        $this->transitions->add($transition);

        if ($default) {
            $this->defaultTransitionKey = $this->transitions->indexOf($transition);
        }
    }

    /**
     * @param $transitionName
     * @return Transition
     * @throws \Exception
     */
    public function getTransition($transitionName)
    {
        $t = $this->transitions->filter(function($transition) use ($transitionName) {
            /** @var Transition $transition */
             return $transition->getName() == $transitionName;
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
    public function hasElements()
    {
        return !$this->elements->isEmpty();
    }

    /**
     * @param Element $element
     */
    public function addElement(Element $element)
    {
        $this->elements->add($element);
    }

    /**
     * @return bool
     */
    public function hadRole()
    {
        return isset($this->role);
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
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @return Transition
     * @throws \Exception
     */
    public function getDefaultTransition()
    {
        if ($this->transitions->isEmpty()) {
            throw new \Exception('State contains no transition');
        }

        // return first if default not set
        if ($this->defaultTransitionKey == null) {
            return $this->transitions->first();
        }

        return $this->transitions->get($this->defaultTransitionKey);
    }

    public function setSelfAsCurrent()
    {
        // TODO: write logic here
    }
}
