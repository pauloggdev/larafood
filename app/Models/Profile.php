<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function permissionDisponivel($filter = null)
    {

        $permissions = Permission::whereNotIn('id', function ($query) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
            ->where(function ($query) use ($filter) {
                if ($filter)
                    $query->where('permissions.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();
        return $permissions;
    }
}
