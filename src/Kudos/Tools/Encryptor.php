<?php

namespace Kudos\Tools;

trait Encryptor
{
    public function hash($string)
    {
        return bcrypt($string);
    }
}
