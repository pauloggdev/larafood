<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [

        'cnpj', 'name', 'url', 'email', 'logo', 'active',
        'subscription', 'expires_at', 'subscription_id', 'subscription_active',
        'subscription_suspended', 'plan_id'

    ];


    public function users(){
        return $this->hasMany(User::class);
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
