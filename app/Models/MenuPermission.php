<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;

/**
 * @property int $id
 * @property int $menu_id
 * @property int $permission_id
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Menu $menu
 * @property-read Permission $permission
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MenuPermission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
