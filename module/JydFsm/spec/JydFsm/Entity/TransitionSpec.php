<?php

namespace spec\JydFsm\Entity;

use JydFsm\Entity\State;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class TransitionSpec extends ObjectBehavior
{
    function let(State $state)
    {
        $this->beConstructedWith($state);
    }
}
