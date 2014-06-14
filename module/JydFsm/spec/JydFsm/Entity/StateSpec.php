<?php

namespace spec\JydFsm\Entity;

use JydFsm\Entity\Machine;
use JydFsm\Entity\State;
use JydFsm\Entity\Transition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class StateSpec extends ObjectBehavior
{
    function let($machine)
    {
        $machine->beADoubleOf('JydFsm\Entity\Machine');

        $this->beConstructedWith($machine, null);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\State');
    }

    function it_can_contain_internal_states(State $state)
    {
        $this->hasInternalStates()->shouldReturn(false);

        $this->addInternalState($state);

        $this->hasInternalStates()->shouldReturn(true);

        $this->addInternalState($state);

        $this->hasInternalStates()->shouldReturn(true);
    }

    function it_can_contain_transitions(Transition $transition)
    {
        $this->hasTransitions()->shouldReturn(false);

        $this->addTransition($transition);

        $this->hasTransitions()->shouldReturn(true);

        $this->addTransition($transition);

        $this->hasTransitions()->shouldReturn(true);
    }

    function it_must_be_able_return_the_machine_it_belongs_to($machine)
    {
        $this->getMachine()->shouldReturn($machine);
    }

    function it_can_set_itself_as_current($machine)
    {
        $machine->setCurrentState($this)->shouldBeCalled();
        $this->setSelfAsCurrent();
    }

    function it_can_find_transition_for_given_transition_name_correctly(Transition $t1, Transition $t2, Transition $t3)
    {
        $t1->getName()->willReturn('test_name_1');
        $t2->getName()->willReturn('test_name_2');
        $t3->getName()->willReturn('test_name_3');

        $this->addTransition($t1);
        $this->addTransition($t2);
        $this->addTransition($t3);

        $this->getTransition('test_name_2')->shouldReturn($t2);
        $this->getTransition('test_name_1')->shouldNotReturn($t2);
        $this->shouldThrow('\Exception')->during('getTransition', array('invalid_name'));
    }
}
