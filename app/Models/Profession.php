<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $fillable = [
        'profession_id',
        'profession_name',
        'description',
        'type',
        'status',
    ];

    protected $primaryKey = 'profession_id';
}
