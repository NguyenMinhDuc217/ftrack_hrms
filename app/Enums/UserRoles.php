<?php

namespace App\Enums;

enum UserRoles: string
{
    case SUPER_ADMIN = "super_admin";
    case ADMIN = "admin";
    case HR_MANAGER = "hr_manager";
}
