<?php
declare(strict_types=1);

namespace App\UseCases\Target;

use App\Repositories\Target\TargetRepository;

class TargetStoreAction
{
    public function __construct(private TargetRepository $targetRepository)
    {
    }

    public function __invoke(int $userId, string $contents, string $expirationDate)
    {
        $expirationDateTime = new \Datetime($expirationDate);

        return $this->targetRepository->save(
            userId: $userId,
            contents: $contents,
            expirationDate: $expirationDateTime->format('Y-m-d 23:59:59')
        );
    }
}
