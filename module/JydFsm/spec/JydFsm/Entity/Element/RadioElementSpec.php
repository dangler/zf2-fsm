<?php

namespace spec\JydFsm\Entity\Element;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RadioElementSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Element\RadioElement');
    }

    function it_must_only_accept_index_if_element_has_that_many_options()
    {
        $this->setOptions(array('one' => 'one', 'two' => 'two', 'three' => 'three'));

        $this->setSelected('one');

        $this->getSelected()->shouldBe('one');

        $this->shouldThrow('\Exception')->duringSetSelected(3);
    }

    function it_must_have_options()
    {
        $this->setOptions(array());

        $this->getOptions()->shouldHaveCount(0);

        $this->setOptions(array('one' => 'one', 'two' => 'two', 'three' => 'three'));

        $this->getOptions()->shouldHaveCount(3);
    }

    function it_can_add_an_option()
    {
        $this->addOption('key', 'value');

        $this->getOptions()->shouldHaveCount(1);

        $this->getSelected()->shouldBe('key');
    }
}
