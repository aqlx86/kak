<?php

namespace spec\Kudos\Usecase\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeleteSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kudos\Usecase\User\Delete');
    }

    /**
     * @param Kudos\Domain\Entity\User $user
     * @param Kudos\Domain\Repository\User $repository
     */
    function let($user, $repository)
    {
        $this->beConstructedWith($user, $repository);
    }

    function it_can_delete_a_user()
    {
        $this->delete_user('id');
    }
}
