<?php
/**
 * Created by PhpStorm.
 * User: dangler
 * Date: 10/6/14
 * Time: 8:59 PM
 */

namespace spec\JydFsm\Factory;
use JydFsm\Entity\Machine;
use JydFsm\Entity\State;
use JydFsm\Entity\Transition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Config\Config;
use Zend\Config\Reader\Json;


class TransitionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\Transition');
    }

    function it_can_create_instance(Machine $machine, State $state, State $target)
    {
        $reader = new Json();
        $data = $reader->fromFile(__DIR__ . '/_transition.test.json');

        $config = new Config($data, true);

        $transition = $this->createTransition($machine, $state, $target, $config);

        // test if instance
        $transition->shouldBeAnInstanceOf('JydFsm\Entity\Transition');

        // test if name was set correctly
        $transition->getName()->shouldReturn($config->name);
    }

    function it_can_throw_error_if_any_required_config_data_missing(Machine $machine, State $state, State $target)
    {
        // test with empty config
        $config = new Config(array(), true);
        $this->shouldThrow('\Exception')->during('createTransition', array($machine, $state, $target, $config));
    }

} 