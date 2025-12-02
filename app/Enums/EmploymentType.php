<?php

namespace App\Enums;

enum EmploymentType: string
{
    case FULLTIME = 'fulltime';
    case PARTTIME = 'parttime';
    case CONTRACT = 'contract';
    case INTERN = 'intern';

    public function getLabelData(): array
    {
        return  match($this) {
            self::FULLTIME => [
                'id' => '1',
                'label' => 'Full-time',
                'lang' => __('user.txt_fulltime'),
            ],
            self::PARTTIME => [
                'id' => '2',
                'label' => 'Part-time',
                'lang' => __('user.txt_parttime'),
            ],
            self::CONTRACT => [
                'id' => '3',
                'label' => 'Contract',
                'lang' => __('user.txt_contract'),
            ],
            self::INTERN => [
                'id' => '4',
                'label' => 'Intern',
                'lang' => __('user.txt_intern'),
            ]
        };
    }
}
