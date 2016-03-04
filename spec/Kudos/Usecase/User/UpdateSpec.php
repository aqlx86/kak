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
     * @param Kudos\Domain\Validator\Validator $validator
     */
    function let($user, $repository, $validator)
    {
        $user->username = 'username';
        $user->password = 'password';
        $user->email = 'email';

        $this->beConstructedWith($user, $repository, $validator);
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

    function it_validates_the_user_entity($user, $validator)
    {
        $inputs = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password
        ];

        $validator->setup($inputs)
            ->shouldBeCalled();

        $validator->set_required('username')
            ->shouldBeCalled();
        $validator->set_required('email')
            ->shouldBeCalled();
        $validator->set_required('password')
            ->shouldBeCalled();

        $validator->validate()
            ->shouldBeCalled()
            ->willReturn(true);

        $this->validate()
            ->shouldReturn(true);
    }

    function it_validates_the_user_entity_then_fail($user, $validator)
    {
        $inputs = [
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password
        ];

        $validator->setup($inputs)
            ->shouldBeCalled();

        $validator->set_required('username')
            ->shouldBeCalled();
        $validator->set_required('email')
            ->shouldBeCalled();
        $validator->set_required('password')
            ->shouldBeCalled();

        $validator->validate()
            ->shouldBeCalled()
            ->willReturn(false);

        $validator->get_errors()
            ->shouldBeCalled()
            ->willReturn([]);

        $this->shouldThrow('Kudos\Exception\Validation')
            ->duringValidate();
    }
}
