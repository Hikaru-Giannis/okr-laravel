<?php
declare(strict_types=1);

namespace App\UseCases\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class StoreAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(string $name, string $email, string $password)
    {
        $hashPassowrd = Hash::make($password);
        $this->userRepository->save(
            name: $name,
            email: $email,
            password: $hashPassowrd
        );
    }
}
