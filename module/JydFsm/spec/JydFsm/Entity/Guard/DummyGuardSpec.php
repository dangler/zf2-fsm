<?php

namespace spec\JydFsm\Entity\Guard;

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
        $this->check()->shouldReturn(true);
    }
}
