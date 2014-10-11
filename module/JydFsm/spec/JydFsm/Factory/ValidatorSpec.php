<?php

namespace spec\JydFsm\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Config\Config;
use Zend\Config\Reader\Json;

class ValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\Validator');
    }

    function it_can_create_instance()
    {
        $reader = new Json();
        $data = $reader->fromFile(__DIR__ . '/_validator.dummy.test.json');

        $config = new Config($data, true);

        $validator = $this->createValidator($config);

        $validator->shouldBeAnInstanceOf('JydFsm\Entity\Validator\DummyValidator');

        // did name and description get set
        $validator->getName()->shouldReturn('Validator 0');
        $validator->getDescription()->shouldReturn('Validator 0 description');
    }
}
