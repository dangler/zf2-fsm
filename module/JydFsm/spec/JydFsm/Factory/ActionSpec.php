<?php

namespace spec\JydFsm\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Config\Config;
use Zend\Config\Reader\Json;

class ActionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\Action');
    }

    function it_can_create_instance()
    {
        $reader = new Json();
        $data = $reader->fromFile(__DIR__ . '/_action.dummy.test.json');

        $config = new Config($data, true);

        $action = $this->createAction($config);

        $action->shouldBeAnInstanceOf('JydFsm\Entity\Action\DummyAction');
    }
}
