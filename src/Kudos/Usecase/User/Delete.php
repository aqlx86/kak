<?php

namespace Kudos\Usecase\User;

use Kudos\Domain\Entity\User;

class Delete
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function delete_user($id)
    {
        // TODO: write logic here
    }
}
