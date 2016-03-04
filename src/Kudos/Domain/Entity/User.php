<?php

namespace Kudos\Domain\Entity;

use Kudos\Domain\Entity\Entity;
use Kudos\Tools\Validator\User as UserValidator;

class User extends Entity
{
    public $username;
    public $email;

    protected $validator;

    public function __construct(UserValidator $validator)
    {
        $this->validator = $validator;
    }

    public function validate()
    {
        return $this->validator->setup($this->to_array());
    }
}
