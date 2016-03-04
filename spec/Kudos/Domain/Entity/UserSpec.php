<?php

namespace spec\Kudos\Domain\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kudos\Domain\Entity\User');
    }

    function it_has_an_id()
    {
        $this->id->shouldBe(null);
    }

    function it_has_an_email()
    {
        $this->email->shouldBe(null);
    }

    function it_has_a_username()
    {
        $this->username->shouldBe(null);
    }

    function it_has_a_password()
    {
        $this->password->shouldBe(null);
    }
}
