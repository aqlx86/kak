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
     * @param Kudos\Domain\Validator\Validator $validator
     */
    function let($kudos, $giver, $receiver, $repository, $validator)
    {
        $giver->id = 'id';
        $receiver->id = 'id';
        $kudos->increase_by(1);

        $this->beConstructedWith($kudos, $giver, $receiver, $repository, $validator);
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

    function it_can_validate($kudos, $giver, $receiver, $validator, $points)
    {
        $kudos->get_count()
            ->shouldBeCalled()
            ->willReturn($points);

        $inputs = [
            'points' => $points,
            'giver_id' => $giver->id,
            'receiver_id' => $receiver->id
        ];

        $validator->setup($inputs)
            ->shouldBeCalled();

        $validator->add_required_rule('points')
            ->shouldBeCalled();
        $validator->add_required_rule('giver_id')
            ->shouldBeCalled();
        $validator->add_required_rule('receiver_id')
            ->shouldBeCalled();

        $validator->validate()
            ->shouldBeCalled()
            ->willReturn(true);

        $this->validate()
            ->shouldReturn(true);
    }

    function it_can_validate_then_fail($kudos, $giver, $receiver, $validator, $points)
    {
        $kudos->get_count()
            ->shouldBeCalled()
            ->willReturn($points);

        $inputs = [
            'points' => $points,
            'giver_id' => $giver->id,
            'receiver_id' => $receiver->id
        ];

        $validator->setup($inputs)
            ->shouldBeCalled();

        $validator->add_required_rule('points')
            ->shouldBeCalled();
        $validator->add_required_rule('giver_id')
            ->shouldBeCalled();
        $validator->add_required_rule('receiver_id')
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
