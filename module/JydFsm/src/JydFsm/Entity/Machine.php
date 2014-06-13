<?php

namespace JydFsm\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use JydFsm\Entity\State;

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
     *
     *
     * @var ArrayCollection
     */
    private $states;

    public function __construct()
    {
        $this->states = new ArrayCollection();
    }

    public function addState(State $state)
    {
        $this->states->add($state);
    }

    public function hasStates()
    {
        return !$this->states->isEmpty();
    }
}
