<?php

namespace Usecase\People;

use Domain\Repository\People\Find as Repository;

class Find
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        return $this->repository->find();
    }
}
