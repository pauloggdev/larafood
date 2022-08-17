<?php

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->products->create([
            'title' => 'Hamburger composto',
            'description' => 'Hamburguer composto para todos',
            'price' => 2000.00
        ]);
        $tenant->products->create([
            'title' => 'Hamburger simples',
            'description' => 'Hamburguer simples para todos',
            'price' => 1200.00
        ]);
    }
}
