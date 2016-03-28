<?php

namespace spec\Kak\Usecase\Kindness;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ActSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kak\Usecase\Kindness\Act');
    }
}
