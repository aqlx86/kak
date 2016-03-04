<?php

namespace Kudos\Usecase\Kudos;

use Kudos\Domain\Entity\User;
use Kudos\Domain\Object\Kudos;
use Kudos\Domain\Repository\User\Kudos as UserKudosRepository;

class Give
{
    protected $kudos;
    protected $giver;
    protected $receiver;
    protected $repository;

    public function __construct(Kudos $kudos, User $giver, User $receiver, UserKudosRepository $repository)
    {
        $this->kudos = $kudos;
        $this->giver = $giver;
        $this->receiver = $receiver;
        $this->repository = $repository;
    }

    public function give()
    {
        $points = $this->kudos->get_count();

        $this->repository->give_kudos($points, $this->giver->id, $this->receiver->id);
    }

    public function validate()
    {
        if (! $this->giver->validate()->is_existing())
            throw new Exception\Validation($this->giver->validator()->get_errors());

        return true;
    }
}
