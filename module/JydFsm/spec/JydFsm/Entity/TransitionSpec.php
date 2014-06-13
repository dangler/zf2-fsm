<?php

namespace spec\JydFsm\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use JydFsm\Entity\State;

class TransitionSpec extends ObjectBehavior
{
    function let(State $state)
    {
        $this->beConstructedWith($state);
    }
}
