<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'Male';
    case FEMALE = 'Female';
    case OTHER = 'Other';

    public function getLabel(): array
    {
        return match($this) {
             self::MALE => [
                'label' => 'Male'
            ],
            self::FEMALE => [
                'label' => 'Female'
            ],
            self::OTHER => [
                'label' => 'Other'
            ]
        };
    }
}
