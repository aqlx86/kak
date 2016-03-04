<?php

namespace spec\Kudos\Usecase\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegisterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kudos\Usecase\User\Register');
    }

    /**
     * @param Kudos\Domain\Entity\User $user
     * @param Kudos\Domain\Repository\User $repository
     */
    function let($user, $repository)
    {
        $user->username = 'john';
        $user->email = 'john@kudos.com';
        $user->password = 'password';

        $this->beConstructedWith($user, $repository);
    }

    function it_creates_the_user($user, $repository)
    {
        $repository->create_user($user->username, $user->email, $user->password)
            ->shouldBeCalled();

        $repository->get_created_id()
            ->shouldBeCalled()
            ->willReturn('id');

        $this->register($user)
            ->shouldReturn('id');
    }

    /**
     * @param Kudos\Tools\Validator\User $user_validator
     * @param Kudos\Tools\Validator\User $validator
     */
    function it_validates_the_user_entity($user, $user_validator, $validator)
    {
        $user->validate()
            ->shouldBeCalled()
            ->willReturn($user_validator);

        $user_validator->create()
            ->shouldBeCalled()
            ->willReturn(true);

        $this->validate()
            ->shouldReturn(true);
    }

    /**
     * @param Kudos\Tools\Validator\User $user_validator
     * @param Kudos\Tools\Validator\User $validator
     */
    function it_validates_the_user_entity_then_fail($user, $user_validator, $validator)
    {
        $user->validate()
            ->shouldBeCalled()
            ->willReturn($user_validator);

        $user_validator->create()
            ->shouldBeCalled()
            ->willReturn(false);

        $user->validator()
            ->shouldBeCalled()
            ->willReturn($validator);

        $validator->get_errors()
            ->shouldBeCalled()
            ->willReturn([]);

        $this->shouldThrow('Kudos\Tools\Exception\Validation')
            ->duringValidate();
    }
}
