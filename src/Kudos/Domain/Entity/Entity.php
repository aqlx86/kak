<?php

namespace Kudos\Domain\Entity;


abstract class Entity
{
    /**
     * return properties
     */
    public function to_array()
    {
        return [];
    }

    public function validator()
    {
        return $this->validator;
    }
}