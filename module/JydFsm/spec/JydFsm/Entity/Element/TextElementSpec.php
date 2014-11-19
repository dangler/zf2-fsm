<?php

namespace spec\JydFsm\Entity\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TextElementSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Element\TextElement');
    }

    function it_can_set_and_get_the_value()
    {
        $this->setValue('Test Value');

        $this->getValue()->shouldBe('Test Value');
    }
}
