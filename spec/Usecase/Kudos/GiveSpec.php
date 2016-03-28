<?php

namespace spec\Usecase\Kudos;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GiveSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Usecase\Kudos\Give');
    }
}
