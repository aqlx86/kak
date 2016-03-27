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
        $this->validate();

        $this->repository->create_user(
            $this->user->username, $this->user->email, $this->user->password
        );

        return $this->repository->get_created_id();
    }

    public function validate()
    {
        $inputs = [
            'username' => $this->user->username,
            'email' => $this->user->email,
            'password' => $this->user->password,
        ];

        $this->validator->setup($inputs);

        $this->validator->add_required_rule('username');
        $this->validator->add_required_rule('email');
        $this->validator->add_email_rule('email');
        $this->validator->add_required_rule('password');
        $this->validator->add_min_length_rule('password', 8);

        if (! $this->validator->validate())
            throw new Exception\Validation($this->validator->get_errors());

        return true;
    }
}
