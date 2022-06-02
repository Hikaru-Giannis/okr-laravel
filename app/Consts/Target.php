<?php

namespace App\Consts;

final class Target
{
    public const STATUS_IMPLEMENTATION = 10;
    public const STATUS_COMPLETION = 20;

    public const STATUS_VALUE_LIST = [
        self::STATUS_IMPLEMENTATION => '実行中',
        self::STATUS_COMPLETION => '終了',
    ];
}
