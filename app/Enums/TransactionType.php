<?php

namespace App\Enums;

enum TransactionType: string
{
    case DEBIT = 'debit';
    case CREDIT = 'credit';

    public static function options(): array
    {
        return array_map(fn($case) => [
            'label' => ucfirst(strtolower($case->name)),
            'value' => $case->value,
        ], self::cases());
    }
    
}
