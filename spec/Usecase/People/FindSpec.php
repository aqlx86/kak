<?php

namespace spec\Usecase\People;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FindSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Usecase\People\Find');
    }

    /**
     * @param Domain\Repository\People\Find $repository
     */
    function let($repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_can_execute_usecase($repository)
    {
        $repository->find()
            ->shouldBeCalled()
            ->willReturn('users');

        $this->execute()
            ->shouldReturn('users');
    }
}
