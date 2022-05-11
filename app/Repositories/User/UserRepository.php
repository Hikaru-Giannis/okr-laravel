<?php
declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    public function save(string $name, string $email, string $password): void
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();
    }
}
