<?php

namespace spec\Usecase\People;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JoinSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Usecase\People\Join');
    }
}
