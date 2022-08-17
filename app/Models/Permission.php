<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function search($filter = null)
    {

        $result = $this->where('name', 'LIKE', "%{$filter}%")
            ->orwhere('description', 'LIKE', "%{$filter}%")->paginate();
        return $result;
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
