<?php

namespace Kudos\Domain\Repository;

interface User
{
    public function create_user($username, $email, $password);

    public function get_created_id();

    public function update_user($id, array $details);
}
