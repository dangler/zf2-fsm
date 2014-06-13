<?php

namespace spec\JydFsm\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use JydFsm\Entity\State;

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
}
