<?php

namespace spec\JydFsm\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use JydFsm\Entity\State;
use JydFsm\Entity\Transition;

class StateSpec extends ObjectBehavior
{
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

    function it_can_contain_transition(Transition $transition)
    {
        $this->hasTransitions()->shouldReturn(false);

        $this->addTransition($transition);

        $this->hasTransitions()->shouldReturn(true);

        $this->addTransition($transition);

        $this->hasTransitions()->shouldReturn(true);
    }
}
