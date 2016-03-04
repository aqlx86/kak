<?php

namespace Kudos\Usecase\User;

use Kudos\Domain\Entity\User;
use Kudos\Domain\Repository\User as UserRepository;
use Kudos\Tools\Exception;

class Register
{
    protected $user;
    protected $repository;

    public function __construct(User $user, UserRepository $repository)
    {
        $this->user = $user;
        $this->repository = $repository;
    }

    public function register()
    {
        $this->repository->create_user(
            $this->user->username, $this->user->email, $this->user->password
        );

        $id = $this->repository->get_created_id();

        return $id;
    }

    public function validate()
    {
        if (! $this->user->validate()->create())
            throw new Exception\Validation($this->user->validator()->get_errors());

        return true;
    }
}
