<?php

namespace App\Enums;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case UNVERIFIED = 'unverified';

    public function getLabelData(): array
    {
        return match($this) {
            self::ACTIVE => [
                'id' => '1',
                'label' => 'Active',
                'lang' => __('user.txt_active'),
                'color' => 'bg-light-success'
            ],
            self::EXPIRED => [
                'id' => '2',
                'label' => 'Expired',
                'lang' => __('user.txt_expired'),
                'color' => 'bg-light-secondary'
            ],
            self::UNVERIFIED => [
                'id' => '3',
                'label' => 'Unverified',
                'lang' => __('user.txt_unverified'),
                'color' => 'bg-light-warning'
            ]
        };
    }
}
