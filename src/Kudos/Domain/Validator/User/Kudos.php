<?php

namespace Kudos\Domain\Validator\User;

use Kudos\Tools\Validator\Validator;

interface Kudos extends Validator
{
    public function give();
}