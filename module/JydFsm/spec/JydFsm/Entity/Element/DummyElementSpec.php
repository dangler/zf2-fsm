<?php

namespace spec\JydFsm\Entity\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DummyElementSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Element\DummyElement');
    }
}
