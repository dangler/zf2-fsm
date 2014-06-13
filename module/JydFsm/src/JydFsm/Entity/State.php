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
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     *
     * $var string
     */
    protected $description;

    /**
     * @ORM\OneToMany(targetEntity="State", mappedBy="parent")
     *
     * @var ArrayCollection
     **/
    protected $states;

    /**
     * @ORM\ManyToOne(targetEntity="State", inversedBy="children")
     *
     * @var State
     **/
    protected $parent;

    /**
     * @ORM\ManyToOne(targetEntity="Transition")
     *
     * @var ArrayCollection
     */
    protected $transitions;

    /**
     *
     */
    public function __construct() {
        $this->states = new ArrayCollection();
        $this->transitions = new ArrayCollection();
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
}
