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
                'label' => 'Male',
                'lang' => __('user.txt_male')
            ],
            self::FEMALE => [
                'label' => 'Female',
                'lang' => __('user.txt_female')
            ],
            self::OTHER => [
                'label' => 'Other',
                'lang' => __('user.txt_other')
            ]
        };
    }
}
