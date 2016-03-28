<?php

namespace Usecase\People\Join;

use Domain\Entity\People;
use Domain\Repository\People as Repository;

class Submission
{
    protected $people;
    protected $repository;

    public function __construct(People $people, Repository $repository)
    {
        $this->people = $people;
        $this->repository = $repository;
    }

    public function join()
    {
        $input = [
            'username' => $this->people->username,
            'email' => $this->people->email,
            'password' => $this->people->hash_password()
        ];

        $this->repository->create_people($input);

        return $this->repository->get_created_id();
    }
}
