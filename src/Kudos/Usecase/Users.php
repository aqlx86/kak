<?php

namespace Kudos\Usecase;

use Kudos\Domain\Repository\Users as UsersRepository;

class Users
{
    protected $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search()
    {
        return $this->repository->search();
    }
}
