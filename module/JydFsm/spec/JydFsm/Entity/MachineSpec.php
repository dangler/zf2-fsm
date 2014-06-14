<?php

namespace spec\JydFsm\Entity;

use JydFsm\Entity\State;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MachineSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Machine');
    }

    function it_can_contain_states(State $state)
    {
        $this->hasStates()->shouldReturn(false);

        $this->addState($state);

        $this->hasStates()->shouldReturn(true);
    }

    function it_must_have_a_current_state(State $state)
    {
        $this->addState($state);

        $this->getCurrentState()->shouldNotBeNull();

        $this->addState($state, true);

        $this->getCurrentState()->shouldNotBeNull();
    }

    function it_can_have_current_state_changed_by_adding_a_new_state_and_setting_it_as_current(State $state)
    {
        $this->addState($state);

        $firstKey = $this->getCurrent();

        $this->addState($state, true);

        $this->getCurrent()->shouldNotEqual($firstKey);
    }
}
