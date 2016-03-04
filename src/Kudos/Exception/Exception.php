<?php

namespace Kudos\Exception;

abstract class Exception extends \Exception
{
    private $errors = array();

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function get_errors()
    {
        return $this->errors;
    }
}