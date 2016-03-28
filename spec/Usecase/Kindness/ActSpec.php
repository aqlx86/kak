<?php

namespace spec\Usecase\Kindness;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ActSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Usecase\Kindness\Act');
    }
}
