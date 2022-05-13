<?php
declare(strict_types=1);

namespace App\Entities\Target;

use App\Entities\Target\TargetEntity;

class TargetListEntitity
{
    private $targetList;
    public function __construct()
    {
        $this->targetList = new \ArrayObject();
    }

    public function add(TargetEntity $target)
    {
        $this->targetList[] = $target;
    }

    public function targetList(): \ArrayObject
    {
        return $this->targetList;
    }
}
