<?php

namespace spec\JydFsm\Factory;

use JydFsm\Entity\Machine;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Config\Config;

class StateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\State');
    }

    function it_can_create_instance(Machine $machine, Config $config)
    {
        $config->name = 'State Test';
        $config->description = 'State Test Description';

        $state = $this->createState($machine, $config);

        $state->shouldBeAnInstanceOf('JydFsm\Entity\State');
    }
}
