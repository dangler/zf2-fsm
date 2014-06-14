<?php

namespace spec\JydFsm\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ActionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Action');
    }
}
