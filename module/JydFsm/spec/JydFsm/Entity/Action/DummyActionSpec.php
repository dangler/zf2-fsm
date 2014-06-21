<?php

namespace spec\JydFsm\Entity\Action;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DummyActionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Action\DummyAction');
    }

    function it_should_do_nothing_and_return_true_when_invoked()
    {
        $this->invoke()->shouldReturn(true);
    }
}
