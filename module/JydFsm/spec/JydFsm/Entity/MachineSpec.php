<?php

namespace spec\JydFsm\Entity;

use JydFsm\Entity\Element\Element;
use JydFsm\Entity\State;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MachineSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Machine');
    }

    function it_can_contain_states(State $state)
    {
        $this->hasStates()->shouldReturn(false);

        $this->addState($state);

        $this->hasStates()->shouldReturn(true);
    }

    function it_can_return_states(State $state)
    {
        $this->getStates()->shouldHaveCount(0);

        $this->addState($state);

        $this->getStates()->shouldHaveCount(1);

        $this->addState($state);

        $this->getStates()->shouldHaveCount(2);
    }

    function it_can_return_elements(Element $element)
    {
        $this->getElements()->shouldHaveCount(0);

        $this->addElement($element);

        $this->getElements()->shouldHaveCount(1);

        $this->addElement($element);

        $this->getElements()->shouldHaveCount(2);
    }

    function it_can_return_state_for_given_state_name(State $s1, State $s2, State $s3)
    {
        $s1->getName()->willReturn('state_1');
        $s2->getName()->willReturn('state_2');
        $s3->getName()->willReturn('state_3');

        $this->addState($s1);
        $this->addState($s2);
        $this->addState($s3);

        $this->getState('state_1')->shouldReturn($s1);
        $this->getState('state_2')->shouldNotReturn($s1);
        $this->shouldThrow('\Exception')->during('getState', array('invalid_name'));
    }


    function it_must_have_a_current_state(State $state)
    {
        $this->addState($state);

        $this->getCurrentState()->shouldNotBeNull();

        $this->addState($state, true);

        $this->getCurrentState()->shouldNotBeNull();
    }

    function it_can_have_current_state_changed_by_adding_a_new_state_and_setting_it_as_current(State $state)
    {
        $this->addState($state);

        $firstKey = $this->getCurrent();

        $this->addState($state, true);

        $this->getCurrent()->shouldNotEqual($firstKey);
    }
}
