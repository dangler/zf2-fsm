<?php

namespace spec\JydFsm\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Config\Config;
use Zend\Config\Reader\Json;

class MachineSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\Machine');
    }

    function it_can_create_instance()
    {
        $reader = new Json();
        $data = $reader->fromFile(__DIR__ . '/_machine.test.json');

        $config = new Config($data, true);

        $machine = $this->createMachine($config);

        $machine->shouldBeAnInstanceOf('JydFsm\Entity\Machine');

        // TODO: makes sure the machine contains the write states and transitions
    }
}
