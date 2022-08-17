<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    protected $fillable = [
        'name', 'url', 'price', 'description'
    ];


    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    public function profiles(){
        return $this->belongsToMany(Profile::class);
    }
    public function tenants(){
        return $this->hasMany(Tenant::class); 
    }


    public function search($filter = null)
    {

        $result = $this->where('name', 'LIKE', "%{$filter}%")
            ->orwhere('description', 'LIKE', "%{$filter}%")->paginate();
        return $result;
    }
    public function profileAvailable($filter = null){

        $profiles = Profile::whereNotIn('id', function ($query) {
            $query->select('plan_profile.plan_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.profile_id={$this->id}");
        })->where(function ($query) use ($filter) {
                if ($filter)
                    $query->where('profiles.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();
        return $profiles;

    }
}
