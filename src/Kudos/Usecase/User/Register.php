<?php

namespace Kudos\Usecase\User;

use Kudos\Domain\Entity\User;
use Kudos\Domain\Repository\User as UserRepository;
use Kudos\Domain\Validator\Validator as Validator;
use Kudos\Exception;

class Register
{
    protected $user;
    protected $repository;
    protected $validator;

    public function __construct(User $user, UserRepository $repository, Validator $validator)
    {
        $this->user = $user;
        $this->repository = $repository;
        $this->validator = $validator;
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
        $inputs = [
            'username' => $this->user->username,
            'email' => $this->user->email,
            'password' => $this->user->password,
        ];

        $this->validator->setup($inputs);
        $this->validator->set_required('username');
        $this->validator->set_required('email');
        $this->validator->set_required('password');

        if (! $this->validator->validate())
            throw new Exception\Validation($this->validator->get_errors());

        return true;
    }
}
