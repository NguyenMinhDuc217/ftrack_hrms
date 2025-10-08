<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;

class MenuPermission extends Model
{
    use HasFactory;

    protected $table = 'menu_permission';

    protected $fillable = [
        'menu_id',
        'permission_id',
        'guard_name',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
