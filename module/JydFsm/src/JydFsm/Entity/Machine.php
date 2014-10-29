<?php

namespace JydFsm\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JydFsm\Entity\Element\Element;

/**
 * Class Machine
 *
 * @package JydFsm\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="machine")
 */
class Machine
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="State", mappedBy="machine")
     *
     * @var ArrayCollection
     */
    private $states;

    /**
     * @ORM\OneToMany(targetEntity="JydFsm\Entity\Element\Element", mappedBy="machine")
     *
     * @var ArrayCollection
     */
    private $elements;

    /**
     * @ORM\OneToMany(targetEntity="Transition", mappedBy="machine")
     *
     * @var ArrayCollection
     */
    private $transitions;

    /**
     * @ORM\OneToMany(targetEntity="JydFsm\Entity\Role", mappedBy="machine")
     *
     * @var ArrayCollection
     */
    private $roles;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $current;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->states = new ArrayCollection();
        $this->elements = new ArrayCollection();
        $this->transitions = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    public function addState(State $state, $isCurrent = false)
    {
        $this->states->add($state);

        if ($isCurrent) {
            $this->current = $this->states->indexOf($state);
        }
    }

    public function hasStates()
    {
        return !$this->states->isEmpty();
    }

    public function getStates()
    {
        return $this->states;
    }

    public function getCurrent()
    {
        return $this->current;
    }

    public function getCurrentState()
    {
        if ($this->current === null) {
            $this->current = $this->states->key();
        }
        return $this->states->get($this->current);
    }

    public function setCurrentState($state)
    {
        $this->current = $this->states->indexOf($state);
    }

    public function getState($stateName)
    {
        $t = $this->states->filter(function($state) use ($stateName) {
            /** @var State $state */
            return $state->getName() == $stateName;
        });

        if ($t->count()) {
            return $t->first();
        }

        throw new \Exception("Transition with name $stateName was not found");
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function addElement(Element $element)
    {
        $this->elements->add($element);
    }

    public function getElement($elementName)
    {
        $e = $this->elements->filter(function($element) use ($elementName) {
            /** @var Element $element */
            return $element->getName() == $elementName;
        });

        if ($e->count()) {
            return $e->first();
        }

        throw new \Exception("Element with name $elementName was not found");
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function addRole(Role $role)
    {
        $this->roles->add($role);
    }
}
