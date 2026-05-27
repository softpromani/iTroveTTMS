<?php

namespace App\Enums;

/**
 * Program types used in the system.
 * Each case maps a value to a human‑readable label.
 */
enum ProgramType: string
{
    case NURSERY_5 = 'Nursery-5';
    case SIX_EIGHT = '6-8';
    case NINE_TWELVE = '9-12';
    case UG = 'UG';
    case PG = 'PG';
    case PHD = 'PhD';

    /**
     * Return an associative array of value => label for dropdowns.
     */
    public static function options(): array
    {
        return [
            self::NURSERY_5->value => 'Primary (Nursery - 5)',
            self::SIX_EIGHT->value => 'Middle (6 - 8)',
            self::NINE_TWELVE->value => 'High School (9 - 12)',
            self::UG->value => 'Undergraduate (UG)',
            self::PG->value => 'Postgraduate (PG)',
            self::PHD->value => 'Doctorate (PhD)',
        ];
    }
}
