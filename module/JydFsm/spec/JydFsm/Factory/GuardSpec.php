<?php

namespace spec\JydFsm\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Config\Config;
use Zend\Config\Reader\Json;

class GuardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\Guard');
    }

    function it_can_create_instance()
    {
        $reader = new Json();
        $data = $reader->fromFile(__DIR__ . '/_guard.dummy.test.json');

        $config = new Config($data, true);

        $guard = $this->createGuard($config);

        $guard->shouldBeAnInstanceOf('JydFsm\Entity\Guard\DummyGuard');

        // did name and description get set
        $guard->getName()->shouldReturn('Guard 0');
        $guard->getDescription()->shouldReturn('Guard 0 description');
    }
}
