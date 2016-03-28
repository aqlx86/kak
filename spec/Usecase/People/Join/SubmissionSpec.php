<?php

namespace spec\Usecase\People\Join;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubmissionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Usecase\People\Join\Submission');
    }

    /**
     * @param Domain\Entity\People $people
     * @param Domain\Repository\People $repository
     */
    function let($people, $repository)
    {
        $people->username = 'username';
        $people->password = 'password';
        $people->email = 'email';

        $this->beConstructedWith($people, $repository);
    }

    function it_can_joins_the_user($people, $repository, $hashed_password)
    {
        $people->hash_password()
            ->shouldBeCalled()
            ->willReturn($hashed_password);

        $input = [
            'username' => $people->username,
            'email' => $people->email,
            'password' => $hashed_password
        ];

        $repository->create_people($input)
            ->shouldBeCalled();

        $repository->get_created_id()
            ->shouldBeCalled()
            ->willReturn('id');

        $this->join()
            ->shouldReturn('id');
    }
}
