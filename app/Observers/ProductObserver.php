<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param  \App\Models\Product $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->uuid =  Str::uuid();
        $product->flag =  Str::kebab($product->title);

    }
     /**
     * Handle the plan "updating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->flag =  Str::kebab($product->title);

    }

}
