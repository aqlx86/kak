<?php

namespace Kudos\Domain\Entity;

use Kudos\Domain\Entity\Entity;

class User extends Entity
{
    public $id;
    public $username;
    public $email;
    public $password;

    public function hash_password()
    {
        return $this->password;
    }
}
