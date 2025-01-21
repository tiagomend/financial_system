<?php

namespace App\Enums;

enum PersonType: string
{
    case LEGAL = 'legal';
    case NATURAL = 'natural';

    public function label(): string
    {
        return match ($this) {
            self::LEGAL => 'Pessoa Jurídica',
            self::NATURAL => 'Pessoa Física',
        };
    }
}
