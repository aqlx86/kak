<?php

namespace spec\Kudos\Usecase\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kudos\Usecase\User\Update');
    }

    /**
     * @param Kudos\Domain\Entity\User $user
     * @param Kudos\Domain\Repository\User $repository
     */
    function let($user, $repository)
    {
        $user->username = 'username';
        $user->password = 'password';
        $user->email = 'email';

        $this->beConstructedWith($user, $repository);
    }

    function it_can_update_the_user($user, $repository)
    {
        $repository->update_user('id', [
            'username' => $user->username,
            'password' => $user->password,
            'email' => $user->email
        ])
        ->shouldBeCalled()
        ->willReturn(true);

        $this->update('id')
            ->shouldReturn(true);
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

        $user_validator->update()
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

        $user_validator->update()
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
