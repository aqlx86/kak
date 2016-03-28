<?php

namespace Domain\Entity;

class People
{
    public $id;
    public $username;
    public $email;
    public $password;

    public function hash_password()
    {
        return bcrypt($this->password);
    }
}
