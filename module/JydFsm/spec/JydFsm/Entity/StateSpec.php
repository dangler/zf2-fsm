<?php

namespace spec\JydFsm\Entity;

use JydFsm\Entity\Machine;
use JydFsm\Entity\State;
use JydFsm\Entity\Transition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class StateSpec extends ObjectBehavior
{
    function let($machine)
    {
        $machine->beADoubleOf('JydFsm\Entity\Machine');

        $this->beConstructedWith($machine);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\State');
    }

    function it_can_contain_internal_states(State $state)
    {
        $this->hasInternalStates()->shouldReturn(false);

        $this->addInternalState($state);

        $this->hasInternalStates()->shouldReturn(true);

        $this->addInternalState($state);

        $this->hasInternalStates()->shouldReturn(true);
    }

    function it_can_contain_transitions(Transition $transition)
    {
        $this->hasTransitions()->shouldReturn(false);

        $this->addTransition($transition);

        $this->hasTransitions()->shouldReturn(true);

        $this->addTransition($transition);

        $this->hasTransitions()->shouldReturn(true);
    }

    function it_can_return_the_machine_it_belongs_to($machine)
    {
        $this->getMachine()->shouldReturn($machine);
    }
}
