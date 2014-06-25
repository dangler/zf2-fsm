<?php

namespace JydFsm\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
}
