<?php

namespace spec\JydFsm\Entity\Guard;

use JydFsm\Entity\Element\Element;
use JydFsm\Entity\State;
use JydFsm\Entity\Transition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ElementsValidGuardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Guard\ElementsValidGuard');
    }

    function it_should_validate_elements(Transition $transition, State $state, Element $element1, Element $element2)
    {
        $element2->isValid()->shouldBeCalled();
        $element2->isValid()->shouldBeCalled();
        $element1->isValid()->willReturn(true);
        $element2->isValid()->willReturn(true);
        $state->getElements()->willReturn(array($element1, $element2));
        $transition->getState()->willReturn($state);

        $this->setTransition($transition);

        $this->check();
    }
}
