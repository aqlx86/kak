<?php

namespace spec\Kudos\Usecase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UsersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kudos\Usecase\Users');
    }

    /**
     * @param Kudos\Domain\Repository\Users $repository
     */
    function let($repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_can_list_users($repository)
    {
        $repository->search()
            ->shouldBeCalled();

        $this->search();
    }
}
