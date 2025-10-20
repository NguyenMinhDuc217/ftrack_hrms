<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';

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
