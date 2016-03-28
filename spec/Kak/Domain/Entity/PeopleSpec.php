<?php

namespace spec\Kak\Domain\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PeopleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kak\Domain\Entity\People');
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

    function it_can_be_verified()
    {
        $this->is_verified->shouldBe(false);
    }

    function it_can_be_invited()
    {
        $this->is_invited->shouldBe(null);
    }
}
