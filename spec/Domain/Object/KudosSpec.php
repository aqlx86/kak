<?php

namespace spec\Domain\Object;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KudosSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Object\Kudos');
    }

    function it_can_increase_the_kudos_count()
    {
        $this->increase_by(1);
    }

    function it_can_get_the_kudos_count()
    {
        $this->get_count()
            ->shouldReturn(0);
    }

    function it_can_get_3_kudos_count()
    {
        $this->it_can_increase_the_kudos_count();
        $this->it_can_increase_the_kudos_count();
        $this->it_can_increase_the_kudos_count();

        $this->get_count()
            ->shouldReturn(3);
    }
}
