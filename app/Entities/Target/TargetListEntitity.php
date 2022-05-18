<?php
declare(strict_types=1);

namespace App\Entities\Target;

class TargetListEntitity
{
    private array $targetList;
    public function __construct(array $targetList)
    {
        $this->targetList = $targetList;
    }

    public function getValue(): array
    {
        return $this->targetList;
    }
}
