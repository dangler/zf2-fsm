<?php

namespace spec\JydFsm\Entity\Validator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DummyValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Validator\DummyValidator');
    }

    function it_should_do_nothing_and_return_true_when_called()
    {
        $result = $this->validate();
        $result->shouldBeAnInstanceOf('JydFsm\Entity\Validator\Result');
    }
}
