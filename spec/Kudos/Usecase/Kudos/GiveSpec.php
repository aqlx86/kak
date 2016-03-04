<?php

namespace spec\Kudos\Usecase\Kudos;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GiveSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kudos\Usecase\Kudos\Give');
    }

    /**
     * @param Kudos\Domain\Object\Kudos $kudos
     * @param Kudos\Domain\Entity\User $giver
     * @param Kudos\Domain\Entity\User $receiver
     * @param Kudos\Domain\Repository\User\Kudos $repository
     */
    function let($kudos, $giver, $receiver, $repository)
    {
        $giver->id = 'id';
        $receiver->id = 'id';
        $kudos->increase_by(1);

        $this->beConstructedWith($kudos, $giver, $receiver, $repository);
    }

    function it_can_give_1_kudos_point_to_user($kudos, $giver, $receiver, $repository, $points)
    {
        $kudos->get_count()
            ->shouldBeCalled()
            ->willReturn($points);

        $repository->give_kudos($points, $receiver->id, $giver->id)
            ->shouldBeCalled();

        $this->give();
    }

    /**
     * @param Kudos\Tools\Validator\User $user_validator
     * @param Kudos\Tools\Validator\User $validator
     */
    function it_validates_the_giver_and_receiver_existence($giver, $user_validator, $validator)
    {
        $giver->validate()
            ->shouldBeCalled()
            ->willReturn($user_validator);

        $user_validator->is_existing()
            ->shouldBeCalled()
            ->willReturn(true);

        $this->validate()
            ->shouldReturn(true);

    }
}
