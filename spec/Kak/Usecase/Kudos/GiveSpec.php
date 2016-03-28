<?php

namespace spec\Kak\Usecase\Kudos;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GiveSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kak\Usecase\Kudos\Give');
    }
}
