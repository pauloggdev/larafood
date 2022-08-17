<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;

    protected $fillable = [

        'title', 'flag', 'description', 'price','image'

    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function categoryAvailable($filter = null){

        $categories = Category::whereNotIn('id', function ($query) {
            $query->select('category_product.product_id');
            $query->from('category_product');
            $query->whereRaw("category_product.category_id={$this->id}");
        })->where(function ($query) use ($filter) {
                if ($filter)
                    $query->where('categories.name', 'LIKE', "%{$filter}%");
            })
            ->paginate();
        return $categories;

    }
    public function search($filter = null)
    {
        $result = $this->where('title', 'LIKE', "%{$filter}%")->paginate();
        return $result;
    }
}
