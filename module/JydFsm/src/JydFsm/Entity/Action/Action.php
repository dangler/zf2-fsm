<?php
/**
 * Created by PhpStorm.
 * User: jdangler
 * Date: 6/13/2014
 * Time: 10:46 PM
 */

namespace JydFsm\Entity\Action;


use Doctrine\ORM\Mapping as ORM;
use JydFsm\Entity\Transition;
use JydFsm\Entity\State;

/**
 * Class Action
 *
 * @package JydFsm\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="action")
 */
abstract class Action
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="JydFsm\Entity\State", inversedBy="$onEntryActions")
     * @ORM\JoinColumn(name="state_entry_id", referencedColumnName="id", nullable=true)
     *
     * @var State
     */
    private $stateEntry;

    /**
     * @ORM\ManyToOne(targetEntity="JydFsm\Entity\State", inversedBy="$onExitActions")
     * @ORM\JoinColumn(name="state_exit_id", referencedColumnName="id", nullable=true)
     *
     * @var State
     */
    private $stateExit;

    /**
     * @ORM\ManyToOne(targetEntity="JydFsm\Entity\Transition", inversedBy="actions")
     * @ORM\JoinColumn(name="transition_id", referencedColumnName="id", nullable=true)
     *
     * @var Transition
     */
    private $transition;

    /**
     * Executes the action
     */
    abstract public function invoke();
} 