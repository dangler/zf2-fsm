<?php

namespace spec\JydFsm\Entity\Element;

use JydFsm\Entity\Validator\Result;
use JydFsm\Entity\Validator\Validator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class DummyElementSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Element\DummyElement');
    }

    function it_can_have_validators(Validator $validator)
    {
        $this->hasValidators()->shouldReturn(false);

        $this->addValidator($validator);

        $this->hasValidators()->shouldReturn(true);
    }

    function it_can_return_validators(Validator $validator)
    {
        $this->getValidators()->shouldHaveCount(0);

        $this->addValidator($validator);

        $this->getValidators()->shouldHaveCount(1);

        $this->addValidator($validator);

        $this->getValidators()->shouldHaveCount(2);
    }

    function it_should_call_all_validators_when_validated(Validator $v1, Validator $v2)
    {
        $this->addValidator($v1);
        $this->addValidator($v2);

        $v1->validate()->shouldBeCalled();
        $v2->validate()->shouldBeCalled();

        $this->isValid();
    }

    function it_returns_true_or_false_on_validation_call(Validator $v1, Result $r1, Validator $v2, Result $r2)
    {
        $r1->result = true;
        $v1->validate()->willReturn($r1);
        $this->addValidator($v1);

        $this->isValid()->shouldReturn(true);

        $r2->result = false;
        $v2->validate()->willReturn($r2);
        $this->addValidator($v2);

        $this->isValid()->shouldReturn(false);
    }

    function it_can_return_validation_results(Validator $v1, Result $r1, Validator $v2, Result $r2)
    {
        $r1->result = true;
        $v1->validate()->willReturn($r1);
        $this->addValidator($v1);

        $r2->result = false;
        $v2->validate()->willReturn($r2);
        $this->addValidator($v2);

        $this->getValidationResults()->shouldHaveCount(2);
    }
}
