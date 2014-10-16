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
        $machine->getState('State 0')->shouldBeAnInstanceOf('JydFsm\Entity\State');
        $machine->getState('State 1')->shouldBeAnInstanceOf('JydFsm\Entity\State');
        $machine->getState('State 2')->shouldBeAnInstanceOf('JydFsm\Entity\State');

        // make sure the states have the onEntryActions and onExitActions speced in the json file
        $machine->getState('State 0')->hasOnEntryActions()->shouldReturn(true);
        $machine->getState('State 1')->hasOnEntryActions()->shouldReturn(false);
        $machine->getState('State 2')->hasOnEntryActions()->shouldReturn(false);
        $machine->getState('State 0')->hasOnExitActions()->shouldReturn(true);
        $machine->getState('State 1')->hasOnExitActions()->shouldReturn(false);
        $machine->getState('State 2')->hasOnExitActions()->shouldReturn(false);

        // make sure the transitions have the actions speced in the json file
        $machine->getState('State 0')->getTransition('Transition 0')->hasActions()->shouldReturn(true);
        $machine->getState('State 1')->getTransition('Transition 1')->hasActions()->shouldReturn(false);

        // make sure the transitions have the guards speced in the json file
        $machine->getState('State 0')->getTransition('Transition 0')->hasGuards()->shouldReturn(true);
        $machine->getState('State 1')->getTransition('Transition 1')->hasGuards()->shouldReturn(false);

        // make sure the states have the appropriate transitions
        $machine->getState('State 0')->getTransition('Transition 0')->shouldBeAnInstanceOf('JydFsm\Entity\Transition');
        $machine->getState('State 1')->getTransition('Transition 1')->shouldBeAnInstanceOf('JydFsm\Entity\Transition');

        // make sure the machine has the elements speced in the json file
        $machine->getElements()->shouldHaveCount(2);
        $machine->getElement('Element 0')->shouldBeAnInstanceOf('JydFsm\Entity\Element\DummyElement');
        $machine->getElement('Element 1')->shouldBeAnInstanceOf('JydFsm\Entity\Element\DummyElement');

        // make sure the states have the elements speced in the json file
        $machine->getState('State 0')->getElement('Element 0')->shouldBeAnInstanceOf('JydFsm\Entity\Element\DummyElement');
        $machine->getState('State 1')->getElement('Element 1')->shouldBeAnInstanceOf('JydFsm\Entity\Element\DummyElement');
    }
}
