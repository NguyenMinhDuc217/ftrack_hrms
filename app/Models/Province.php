<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'code',
        'name',
        'name_en',
        'full_name',
        'full_name_en',
        'code_name',
        'unit_id',
    ];

     protected $primaryKey = 'id';

}
