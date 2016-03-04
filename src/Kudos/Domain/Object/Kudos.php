<?php

namespace Kudos\Domain\Object;

class Kudos
{
    protected $count;

    public function __construct()
    {
        $this->count = 0;
    }

    public function increase_by($count)
    {
        $this->count+= $count;
    }

    public function get_count()
    {
        return (int) $this->count;
    }
}
