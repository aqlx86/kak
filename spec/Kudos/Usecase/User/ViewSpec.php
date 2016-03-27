<?php

namespace spec\Kudos\Usecase\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ViewSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kudos\Usecase\User\View');
    }

    /**
     * @param Kudos\Domain\Entity\User $user
     * @param Kudos\Domain\Repository\User $repository
     * @param Kudos\Domain\Validator\Validator $validator
     */
    function let($user, $repository, $validator)
    {
        $user->id = 1;

        $this->beConstructedWith($user, $repository, $validator);
    }

    function it_validates_the_user($user, $validator)
    {
        $validator->setup([
            'id' => $user->id
        ])
            ->shouldBeCalled();

        $validator->add_required_rule('id')
            ->shouldBeCalled();

        $validator->validate()
            ->shouldBeCalled()
            ->willReturn(true);

        $this->validate()
            ->shouldReturn(true);
    }

    function it_validates_the_user_then_failes($user, $validator)
    {
        $validator->setup([
            'id' => $user->id
        ])
            ->shouldBeCalled();

        $validator->add_required_rule('id')
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

    function it_can_load_the_user($user, $repository)
    {
        $repository->view($user->id)
            ->shouldBeCalled()
            ->willReturn('user');

        $this->view()
            ->shouldReturn('user');
    }
}
