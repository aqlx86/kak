<?php

namespace Kudos\Domain\Repository\User;

interface Kudos
{
    public function give_kudos($points, $giver_id, $receiver_id);
}
