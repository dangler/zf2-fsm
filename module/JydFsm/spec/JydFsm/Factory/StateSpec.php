<?php

namespace spec\JydFsm\Factory;

use JydFsm\Entity\Machine;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Config\Config;
use Zend\Config\Reader\Json;

class StateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\State');
    }

    function it_can_create_instance(Machine $machine)
    {
        $reader = new Json();
        $data = $reader->fromFile(__DIR__ . '/_state.test.json');

        $config = new Config($data, true);

        $state = $this->createState($machine, $config);

        // test if instance
        $state->shouldBeAnInstanceOf('JydFsm\Entity\State');

        // test if name was set correctly
        $state->getName()->shouldReturn($config->name);

        // test if description was set correctly
        $state->getDescription()->shouldReturn($config->description);
    }

    function it_can_throw_error_if_any_required_config_data_missing(Machine $machine)
    {
        // test with empty config
        $config = new Config(array(), true);
        $this->shouldThrow('\Exception')->during('createState', array($machine, $config));

        // test with description missing
        $config = new Config(array(), true);
        $config->name = 'Test Name';
        $this->shouldThrow('\Exception')->during('createState', array($machine, $config));

        // test with name missing
        $config = new Config(array(), true);
        $config->description = 'Test Description';
        $this->shouldThrow('\Exception')->during('createState', array($machine, $config));
    }

}
