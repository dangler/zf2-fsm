<?php

namespace spec\JydFsm\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MachineSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\Machine');
    }

    function it_can_create_instance()
    {
        $machine = $this->createMachine();

        $machine->shouldBeAnInstanceOf('JydFsm\Entity\Machine');
    }
}
