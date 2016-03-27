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
        $user->id = 'id';
        $user->username = 'username';

        $this->beConstructedWith($user, $repository, $validator);
    }

    function it_can_update_the_user($user, $repository)
    {
        $user_data = [];

        if ($user->username)
            $user_data['username'] = $user->username;

        $repository->update_user('id', $user_data)
            ->shouldBeCalled()
            ->willReturn(true);

        $this->update()
            ->shouldReturn(true);
    }

    function it_validates_the_user_entity($user, $validator)
    {
        $inputs = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password
        ];

        $validator->setup($inputs)
            ->shouldBeCalled();

        $validator->add_required_rule('id')
                ->shouldBeCalled();

        if ($user->username)
        {
            $validator->add_required_rule('username')
                ->shouldBeCalled();
        }

        if ($user->email)
        {
            $validator->add_required_rule('email')
                ->shouldBeCalled();

            $validator->add_email_rule('email')
                ->shouldBeCalled();
        }

        if ($user->password)
        {
            $validator->add_required_rule('password')
                ->shouldBeCalled();

            $validator->add_min_length_rule('password', 8)
                ->shouldBeCalled();
        }

        $validator->validate()
            ->shouldBeCalled()
            ->willReturn(true);

        $this->validate()
            ->shouldReturn(true);
    }

    function it_validates_the_user_entity_then_fail($user, $validator)
    {
        $inputs = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password
        ];

        $validator->setup($inputs)
            ->shouldBeCalled();

        $validator->add_required_rule('id')
                ->shouldBeCalled();

        if ($user->username)
        {
            $validator->add_required_rule('username')
                ->shouldBeCalled();
        }

        if ($user->email)
        {
            $validator->add_required_rule('email')
                ->shouldBeCalled();

            $validator->add_email_rule('email')
                ->shouldBeCalled();
        }

        if ($user->password)
        {
            $validator->add_required_rule('password')
                ->shouldBeCalled();

            $validator->add_min_length_rule('password', 8)
                ->shouldBeCalled();
        }

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
