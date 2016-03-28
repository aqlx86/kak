<?php

namespace spec\Kak\Domain\Object;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KindnessSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kak\Domain\Object\Kindness');
    }
}
