<?php

namespace Kudos\Domain\Validator;

interface Validator
{
    public function setup($inputs);

    public function add_required_rule($key);

    public function add_email_rule($key);

    public function add_min_length_rule($key, $number_of_chars);

    public function add_callback($key, $function, $message);

    public function validate();

    public function get_errors();
}
