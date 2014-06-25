<?php

namespace spec\JydFsm\Entity;

use JydFsm\Entity\Action\DummyAction as Action;
use JydFsm\Entity\Guard\DummyGuard as Guard;
use JydFsm\Entity\Guard\Result;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class TransitionSpec extends ObjectBehavior
{
    function let($state, $target)
    {
        $state->beADoubleOf('JydFsm\Entity\State');
        $target->beADoubleOf('JydFsm\Entity\State');

        $this->beConstructedWith($state, $target);
    }

    function it_must_be_able_to_return_owning_state($state)
    {
        $this->getState()->shouldReturn($state);
    }

    function it_must_be_able_to_return_target_state($target)
    {
        $this->getTarget()->shouldReturn($target);
    }

    function it_can_change_the_machines_current_state_to_its_target_state_when_executing($target)
    {
        $target->invokeOnEntryActions()->shouldBeCalled();
        $target->setSelfAsCurrent()->shouldBeCalled();
        $this->execute();
    }

    function it_may_have_actions(Action $action)
    {
        $this->hasActions()->shouldReturn(false);

        $this->addAction($action);

        $this->hasActions()->shouldReturn(true);
    }

    function it_invokes_actions_when_executing(Action $a1, Action $a2)
    {
        $this->addAction($a1);
        $this->addAction($a2);

        $a1->invoke()->shouldBeCalled();
        $a2->invoke()->shouldBeCalled();

        $this->execute();
    }

    function it_invokes_source_state_on_exit_actions_when_executing($state)
    {
        $state->invokeOnExitActions()->shouldBeCalled();

        $this->execute();
    }

    function it_invokes_target_state_on_entry_actions_when_executing($target)
    {
        $target->invokeOnEntryActions()->shouldBeCalled();
        $target->setSelfAsCurrent()->shouldBeCalled();

        $this->execute();
    }

    function it_can_have_guards()
    {
        $this->hasGuards()->shouldReturn(false);
    }

    function it_checks_guards_when_executing(Guard $g)
    {
        $this->addGuard($g);

        $g->check()->shouldBeCalled();

        $this->execute();
    }

    function it_returns_guard_results_if_a_guard_fails(Guard $g1, Result $r1, Guard $g2, Result $r2)
    {
        $r1->result = true;
        $g1->check()->willReturn($r1);
        $this->addGuard($g1);

        $r2->result = false;
        $g2->check()->willReturn($r2);
        $this->addGuard($g2);

        $results = $this->checkGuards();
        $results->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }

    function it_returns_true_if_all_guards_pass(Guard $g1, Result $r1, Guard $g2, Result $r2)
    {
        $r1->result = true;
        $g1->check()->willReturn($r1);
        $this->addGuard($g1);

        $r2->result = true;
        $g2->check()->willReturn($r2);
        $this->addGuard($g2);

        $this->checkGuards()->shouldReturn(true);
    }
}
