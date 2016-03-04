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
     * @param Kudos\Domain\Validator\Validator $validator
     */
    function let($user, $repository, $validator)
    {
        $user->username = 'john';
        $user->email = 'john@kudos.com';
        $user->password = 'password';

        $this->beConstructedWith($user, $repository, $validator);
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
