<?php

namespace spec\JydFsm\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Config\Config;
use Zend\Config\Reader\Json;

class ElementSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Factory\Element');
    }

    function it_can_create_instance()
    {
        $reader = new Json();
        $data = $reader->fromFile(__DIR__ . '/_element.dummy.test.json');

        $config = new Config($data, true);

        $element = $this->createElement($config);

        $element->shouldBeAnInstanceOf('JydFsm\Entity\Element\DummyElement');

        // did name get set
        $element->getName()->shouldReturn('Element 0');
    }
}
