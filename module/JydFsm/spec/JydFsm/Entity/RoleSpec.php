<?php

namespace spec\JydFsm\Entity;

use JydFsm\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('JydFsm\Entity\Role');
    }

    function it_can_have_user_set(User $user)
    {
        $this->setUser($user);

        $this->getUser()->shouldReturn($user);
    }
}
