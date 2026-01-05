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

    protected $appends = ['localized_name'];

    public function getLocalizedNameAttribute()
    {
        $locale = app()->getLocale();

        return $locale === 'en' ? $this->name_en : $this->name;
    }
}
