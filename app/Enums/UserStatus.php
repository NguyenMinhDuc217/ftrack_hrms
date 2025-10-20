<?php

namespace App\Enums;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case UNVERIFIED = 'unverified';

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
            self::UNVERIFIED => [
                'id' => '3',
                'label' => 'Unverified',
                'color' => 'bg-light-warning'
            ]
        };
    }
}
