<?php

namespace Kak\Usecase\People;

use Kak\Domain\Entity\People;
use Kak\Domain\Repository\People as Repository;
use Kak\Tools\Validator;
use Kak\Exception;

use Kak\Usecase\People\Join\Submission;

class Invite
{
    protected $people;
    protected $repository;
    protected $validator;

    public function __construct(People $people, Repository $repository, Validator $validator)
    {
        $this->people = $people;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function invite()
    {
        $this->people->is_invited = true;

        $submission = new Submission($this->people, $this->repository);
        return $submission->join();
    }

    public function validate()
    {
        $inputs = [
            'username' => $this->people->username,
            'email' => $this->people->email,
            'password' => $this->people->password,
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

    public function execute()
    {
        $this->validate();
        return $this->invite();
    }
}
