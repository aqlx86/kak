<?php

namespace Kak\Domain\Entity;

class People
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $is_verified = false;
    public $is_invited;

    public function hash_password()
    {
        return bcrypt($this->password);
    }
}
