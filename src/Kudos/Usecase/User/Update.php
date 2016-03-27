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

    public function run()
    {
        $this->validate();
        $this->update();
    }

    public function update()
    {
        $user_data = [];

        if ($this->user->username)
            $user_data['username'] = $this->user->username;

        if ($this->user->email)
            $user_data['email'] = $this->user->email;

        if ($this->user->password)
            $user_data['password'] = $this->user->password;

        return $this->repository->update_user($this->user->id, $user_data);
    }

    public function validate()
    {
        $inputs = [
            'id' => $this->user->id,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'password' => $this->user->password,
        ];

        $this->validator->setup($inputs);

        $this->validator->add_required_rule('id');

        if ($this->user->username)
            $this->validator->add_required_rule('username');

        if ($this->user->email)
        {
            $this->validator->add_required_rule('email');
            $this->validator->add_email_rule('email');
        }

        if ($this->user->password)
        {
            $this->validator->add_required_rule('password');
            $this->validator->add_min_length_rule('password', 8);
        }

        if (! $this->validator->validate())
            throw new Exception\Validation($this->validator->get_errors());

        return true;
    }
}
