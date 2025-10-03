<?php

namespace App\Enums;

enum EmploymentType: string
{
    case FULLTIME = 'Full-time';
    case PARTTIME = 'Part-time';
    case CONTRACT = 'Contract';
    case INTERN = 'Intern';
}
