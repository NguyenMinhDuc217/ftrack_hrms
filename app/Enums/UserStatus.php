<?php

namespace App\Enums;

enum UserStatus: string
{
    case ACTIVE = 'Active';
    case EXPIRED = 'Expired';
    case SUPERSEDED = 'Superseded';

    public function getLabelData(): array
    {
        return  match($this) {
            self::ACTIVE => [
                'id' => '1',
                'label' => 'Active',
                'color' => 'bg-light-success'
            ],
            self::EXPIRED => [
                'id' => '2',
                'label' => 'Expired',
                'color' => 'bg-light-secondary'
            ],
            self::SUPERSEDED => [
                'id' => '3',
                'label' => 'Superseded',
                'color' => 'bg-light-warning'
            ]
        };
    }
}
