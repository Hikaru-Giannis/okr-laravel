<?php
declare(strict_types=1);

namespace App\UseCases\Target;

use App\Repositories\Target\TargetRepository;

class StoreAction
{
    public function __construct(private TargetRepository $targetRepository)
    {
    }

    public function __invoke(int $userId, string $contents, string $expirationDate)
    {
        return $this->targetRepository->save(
            userId: $userId,
            contents: $contents,
            expirationDate: $expirationDate
        );
    }
}
