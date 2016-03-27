<?php

namespace Kudos\Usecase\User;

use Kudos\Domain\Entity\User;
use Kudos\Domain\Repository\User as UserRepository;
use Kudos\Domain\Validator\User as UserValidator;
use Kudos\Exception;

class Register
{
    protected $user;
    protected $repository;
    protected $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function register(User $user)
    {
        $this->validator->setup([
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        if (! $this->validator->validate('register'))
            throw new Exception\Validation($this->validator->get_errors());

        $this->repository->create_user(
            $this->user->username, $this->user->email, $this->user->password
        );

        $id = $this->repository->get_created_id();

        return $id;
    }
}
