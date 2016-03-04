<?php

namespace Kudos\Domain\Entity;

use Kudos\Domain\Entity\Entity;
use Kudos\Tools\Validator\User as UserValidator;

class User extends Entity
{
    public $id;
    public $username;
    public $email;
    public $password;

    protected $validator;
    protected $kudos;

    public function __construct(UserValidator $validator)
    {
        $this->validator = $validator;
    }

    public function validate()
    {
        return $this->validator->setup($this->to_array());
    }
}
