<?php

namespace spec\JydFsm\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Config\Config;
use Zend\Config\Reader\Json;

class RoleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\Role');
    }

    function it_can_create_instance()
    {
        $reader = new Json();
        $data = $reader->fromFile(__DIR__ . '/_role.test.json');

        $config = new Config($data, true);

        $role = $this->createRole($config);

        $role->shouldBeAnInstanceOf('JydFsm\Entity\Role');

        // did name and description get set
        $role->getName()->shouldReturn('Role 0');
        $role->getDescription()->shouldReturn('Role 0 description');
    }
}
