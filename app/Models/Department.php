<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department_id',
        'department_name',
        'description',
        'status',
    ];

     protected $primaryKey = 'department_id';
}
