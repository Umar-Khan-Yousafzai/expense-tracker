<?php

namespace App;

enum ExpenseType:int
{
    case SINGLE_EXPENSE = 1;
    case SHARED_EXPENSE = 2;

    public function isShared(): bool
    {
        return $this === self::SHARED_EXPENSE;
    }
    public function isSingle(): bool
    {
        return $this === self::SINGLE_EXPENSE;
    }
}
