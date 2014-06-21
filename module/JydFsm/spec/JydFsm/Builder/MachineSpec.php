<?php

namespace spec\JydFsm\Builder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MachineSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Builder\Machine');
    }
}
