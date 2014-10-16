<?php

namespace spec\JydFsm\Entity;

use JydFsm\Entity\Element\Element;
use JydFsm\Entity\Role;
use JydFsm\Entity\Machine;
use JydFsm\Entity\State;
use JydFsm\Entity\Transition;
use JydFsm\Entity\Action\DummyAction as Action;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StateSpec extends ObjectBehavior
{
    function let($machine)
    {
        $machine->beADoubleOf('JydFsm\Entity\Machine');

        $this->beConstructedWith($machine, false);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\State');
    }

    function it_can_have_transitions(Transition $t1, Transition $t2)
    {
        $this->hasTransitions()->shouldReturn(false);

        $this->addTransition($t1);

        $this->hasTransitions()->shouldReturn(true);

        $this->addTransition($t2);

        $this->hasTransitions()->shouldReturn(true);
    }

    function it_can_set_default_transition(Transition $t1, Transition $t2)
    {
        $this->addTransition($t1);

        //defaults to first transition if default not specified
        $this->getDefaultTransition()->shouldReturn($t1);

        $this->addTransition($t2, true);

        $this->getDefaultTransition()->shouldReturn($t2);
    }

    function it_must_have_a_role_assigned(Role $role)
    {
        $this->addRole($role);

        $this->hasRoles()->shouldReturn(true);
    }

    function it_can_return_transition_for_given_transition_name(Transition $t1, Transition $t2, Transition $t3)
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

    function it_can_have_on_entry_actions(Action $a1)
    {
        $this->hasOnEntryActions()->shouldReturn(false);

        $this->addOnEntryAction($a1);

        $this->hasOnEntryActions()->shouldReturn(true);
    }

    function it_can_have_on_exit_actions(Action $a1)
    {
        $this->hasOnExitActions()->shouldReturn(false);

        $this->addOnExitAction($a1);

        $this->hasOnExitActions()->shouldReturn(true);
    }

    function it_can_have_elements(Element $element)
    {
        $this->hasElements()->shouldReturn(false);

        $this->addElement($element);

        $this->hasElements()->shouldReturn(true);
    }

    function it_can_validate_elements(Element $e1, Element $e2)
    {
        $this->addElement($e1);
        $this->addElement($e2);

        $e1->isValid()->shouldBeCalled();
        $e2->isValid()->shouldBeCalled();

        $this->validateElements();
    }
}
