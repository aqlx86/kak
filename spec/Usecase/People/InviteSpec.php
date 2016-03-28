<?php

namespace spec\Usecase\People;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InviteSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Usecase\People\Invite');
    }

    /**
     * @param Domain\Entity\People $people
     * @param Domain\Repository\People $repository
     * @param Tools\Validator $validator
     */
    function let($people, $repository, $validator)
    {
        $this->beConstructedWith($people, $repository, $validator);
    }

    function it_can_invite_someone($people, $repository, $submission)
    {
        $people->is_invited = true;

        $submission->beADoubleOf('Usecase\People\Join\Submission', [$people, $repository]);
        // @todo this should be called
        $submission->join();

        $this->invite();
    }

    function it_can_validate_user($people, $validator)
    {
        $inputs = [
            'username' => $people->username,
            'email' => $people->email,
            'password' => $people->password
        ];

        $validator->setup($inputs)
            ->shouldBeCalled();

        $validator->add_required_rule('username')
                ->shouldBeCalled();

        $validator->add_required_rule('email')
                ->shouldBeCalled();

        $validator->add_email_rule('email')
            ->shouldBeCalled();

        $validator->add_required_rule('password')
                ->shouldBeCalled();

        $validator->add_min_length_rule('password', 8)
            ->shouldBeCalled();

        $validator->validate()
            ->shouldBeCalled()
            ->willReturn(true);

        $this->validate()
            ->shouldReturn(true);

        $this->validate();
    }

    function it_validates_the_user_then_fail($people, $validator)
    {
        $inputs = [
            'username' => $people->username,
            'email' => $people->email,
            'password' => $people->password
        ];

        $validator->setup($inputs)
            ->shouldBeCalled();

        $validator->add_required_rule('username')
                ->shouldBeCalled();

        $validator->add_required_rule('email')
                ->shouldBeCalled();

        $validator->add_email_rule('email')
            ->shouldBeCalled();

        $validator->add_required_rule('password')
                ->shouldBeCalled();

        $validator->add_min_length_rule('password', 8)
            ->shouldBeCalled();

        $validator->validate()
            ->shouldBeCalled()
            ->willReturn(false);

        $validator->get_errors()
            ->shouldBeCalled()
            ->willReturn([]);

        $this->shouldThrow('Exception\Validation')
            ->duringValidate();
    }

    function it_can_execute_the_usecase($people, $repository, $submission, $validator)
    {
        $this->it_can_validate_user($people, $validator);
        $this->it_can_invite_someone($people, $repository, $submission);

        $this->execute();
    }
}
