<?php

namespace Kudos\Usecase\User;

use Kudos\Domain\Entity\User;
use Kudos\Domain\Repository\User as UserRepository;
use Kudos\Domain\Validator\Validator;
use Kudos\Exception;

class View
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

    public function validate()
    {
        $this->validator->setup([
            'id' => $this->user->id
        ]);

        $this->validator->add_required_rule('id');

        if (! $this->validator->validate())
            throw new Exception\Validation($this->validator->get_errors());

        return true;
    }

    public function view()
    {
        $user = $this->repository->view($this->user->id);

        if (! $user)
            throw new Exception\EntityNotFound(['User does not exists.']);

        return $user;
    }
}
