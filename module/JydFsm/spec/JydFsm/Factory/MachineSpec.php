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

        // make sure the machine has 3 states as speced in the json file
        $machine->getStates()->shouldHaveCount(3);

        // make sure the states have the appropriate transitions
        // TODO
    }
}
