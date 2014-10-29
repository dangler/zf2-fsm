<?php

namespace spec\JydFsm\Entity\Guard;

use JydFsm\Entity\Transition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DummyGuardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Guard\DummyGuard');
    }

    function it_should_do_nothing_and_return_true_when_invoked()
    {
        $result = $this->check();
        $result->shouldBeAnInstanceOf('JydFsm\Entity\Guard\Result');
        $result->result->shouldBe(true);
    }

    function it_can_set_and_get_the_owning_transition(Transition $transition)
    {
        $this->setTransition($transition);

        $this->getTransition()->shouldBe($transition);
    }
}
