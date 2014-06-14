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

use JydFsm\Entity\Transition;
use JydFsm\Entity\Machine;

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
     * @ORM\OneToMany(targetEntity="State", mappedBy="parent")
     *
     * @var ArrayCollection
     **/
    private $states;

    /**
     * @ORM\ManyToOne(targetEntity="State", inversedBy="children")
     *
     * @var State
     **/
    private $parent;

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
     *
     */
    public function __construct(Machine $machine) {
        $this->states = new ArrayCollection();
        $this->transitions = new ArrayCollection();
        $this->machine = $machine;
    }

    /**
     * @param State $state
     */
    public function addInternalState(State $state)
    {
        $this->states->add($state);
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

        if ($t) {
            return $t->first();
        }

        throw new \Exception("Transition with name $transitionName was not found");
    }
}
