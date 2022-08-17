<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use TenantTrait;
    
    protected $fillable = [
        'identify',
        'uuid',
        'description',
        'tenant_id'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function search($filter = null)
    {
        $result = $this->where('identify', 'LIKE', "%{$filter}%")->paginate();
        return $result;
    }
}
