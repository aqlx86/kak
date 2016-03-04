<?php

namespace Kudos\Domain\Validator;

interface Validator
{
    public function setup($inputs);

    public function set_required($key);

    public function validate();

    public function get_errors();
}