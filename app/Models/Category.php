<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Category extends Model
{
    use TenantTrait;
    //
    protected $fillable = [
        'name',
        'url',
        'description',
        'tenant_id'
    ];

   

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function search($filter = null)
    {
        $result = $this->where('name', 'LIKE', "%{$filter}%")->paginate();
        return $result;
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function productsAvailable($filter = null){

        $products = Product::whereNotIn('id', function ($query) {
            $query->select('category_product.product_id');
            $query->from('category_product');
            $query->whereRaw("category_product.category_id={$this->id}");
        })->where(function ($query) use ($filter) {
                if ($filter)
                    $query->where('categories.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();
        return $products;

    }

    public function scopeTenantFilter(Builder $query)
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }
}
