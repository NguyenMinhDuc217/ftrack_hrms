<?php

namespace App\Enums;

enum GeneralStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function getLabelData(): array
    {
        return match ($this) {
            self::ACTIVE => [
                'id' => '1',
                'label' => 'Active',
                'lang' => __('default.txt_active'),
                'color' => 'bg-light-success',
            ],
            self::INACTIVE => [
                'id' => '0',
                'label' => 'Inactive',
                'lang' => __('default.txt_inactive'),
                'color' => 'bg-light-secondary',
            ],
        };
    }
}
