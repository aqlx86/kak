<?php

namespace Kudos\Usecase\Kudos;

use Kudos\Domain\Entity\User;
use Kudos\Domain\Object\Kudos;
use Kudos\Domain\Repository\User\Kudos as UserKudosRepository;
use Kudos\Domain\Validator\Validator as Validator;
use Kudos\Exception;

class Give
{
    protected $kudos;
    protected $giver;
    protected $receiver;
    protected $repository;
    protected $validator;

    public function __construct(Kudos $kudos, User $giver, User $receiver, UserKudosRepository $repository, Validator $validator)
    {
        $this->kudos = $kudos;
        $this->giver = $giver;
        $this->receiver = $receiver;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function give()
    {
        $points = $this->kudos->get_count();

        $this->repository->give_kudos($points, $this->giver->id, $this->receiver->id);
    }

    public function validate()
    {
        $inputs = [
            'points' => $this->kudos->get_count(),
            'giver_id' => $this->giver->id,
            'receiver_id' => $this->receiver->id
        ];

        $this->validator->setup($inputs);
        $this->validator->set_required('points');
        $this->validator->set_required('giver_id');
        $this->validator->set_required('receiver_id');

        if (! $this->validator->validate())
            throw new Exception\Validation($this->validator->get_errors());

        return true;
    }

    public function validate2()
    {
        if (! $this->giver->validate()->is_existing())
            throw new Exception\Validation($this->giver->validator()->get_errors());

        return true;
    }
}
