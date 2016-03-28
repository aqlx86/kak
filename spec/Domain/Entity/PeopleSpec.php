<?php

namespace spec\Domain\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PeopleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Entity\People');
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
