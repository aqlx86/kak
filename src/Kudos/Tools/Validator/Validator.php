<?php

namespace Kudos\Tools\Validator;

interface Validator
{
    public function setup($inputs);

    public function get_errors();
}
