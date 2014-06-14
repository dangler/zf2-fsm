<?php

namespace spec\JydFsm\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class TransitionSpec extends ObjectBehavior
{
    function let($state, $target)
    {
        $state->beADoubleOf('JydFsm\Entity\State');
        $target->beADoubleOf('JydFsm\Entity\State');

        $this->beConstructedWith($state, $target);
    }

    function it_must_be_able_to_return_owning_state($state)
    {
        $this->getState()->shouldReturn($state);
    }

    function it_must_be_able_to_return_target_state($target)
    {
        $this->getTarget()->shouldReturn($target);
    }

    function it_can_change_the_machines_current_state_to_its_target_state_when_executing($target)
    {
        $target->setSelfAsCurrent()->shouldBeCalled();
        $this->execute();
    }
}
