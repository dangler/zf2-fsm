<?php

namespace spec\JydFsm\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Test');
    }

    function it_has_a_firstname()
    {
        $this->getFirstName()->shouldReturn(null);

        $this->setFirstName('Test');

        $this->getFirstName()->shouldReturn('Test');

    }
}
