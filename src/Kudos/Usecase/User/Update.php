<?php

namespace Kudos\Usecase\User;

use Kudos\Domain\Entity\User;
use Kudos\Domain\Repository\User as UserRepository;
use Kudos\Domain\Validator\Validator as Validator;
use Kudos\Exception;

class Update
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
