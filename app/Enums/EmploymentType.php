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
            ],
            self::PARTTIME => [
                'id' => '2',
                'label' => 'Part-time',
            ],
            self::CONTRACT => [
                'id' => '3',
                'label' => 'Contract',
            ],
            self::INTERN => [
                'id' => '4',
                'label' => 'Intern',
            ]
        };
    }
}
