<?php

namespace Kudos\Usecase\User;

use Kudos\Domain\Entity\User;
use Kudos\Domain\Repository\User as UserRepository;
use Kudos\Tools\Exception;

class Update
{
    protected $user;
    protected $repository;

    public function __construct(User $user, UserRepository $repository)
    {
        $this->user = $user;
        $this->repository = $repository;
    }

    public function update($id)
    {
        return $this->repository->update_user($id, [
            'username' => $this->user->username,
            'password' => $this->user->password,
            'email' => $this->user->email
        ]);
    }

    public function validate()
    {
        if (! $this->user->validate()->update())
            throw new Exception\Validation($this->user->validator()->get_errors());

        return true;
    }
}
