<?php
declare(strict_types=1);

namespace App\Entities\User;

class UserEntity
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email
    )
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }
}
