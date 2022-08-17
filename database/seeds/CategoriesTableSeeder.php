<?php

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();
        $tenant->categories()->create(['name' => 'Bebidas', 'url' => Str::slug('bebidas')]);
        $tenant->categories()->create(['name' => 'Alimentos', 'url' => Str::slug('Alimentos')]);
        $tenant->categories()->create(['name' => 'Electrónicos', 'url' => Str::slug('Electrónicos')]);
    }
}
