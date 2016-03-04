<?php

namespace Kudos\Tools\Validator;

use Kudos\Tools\Validator\Validator;

interface User extends Validator
{
    public function create();

    public function update();

    public function is_existing();
}
