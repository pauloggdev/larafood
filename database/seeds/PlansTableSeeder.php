<?php

use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::create(['name' => 'Business', 'url' => 'business', 'price' => 499.99]);

        $plan->details()->create(['name' => 'Categoria']);
        $plan->details()->create(['name' => 'Produtos']);
        $plan->details()->create(['name' => 'Mesas']);
        $plan->details()->create(['name' => 'Avaliações']);
        $plan->details()->create(['name' => 'Pedidos']);

        $plan = Plan::create(['name' => 'Free', 'url' => 'free', 'price' => 0]);
        $plan->details()->create(['name' => 'Categoria']);
        $plan->details()->create(['name' => 'Produtos']);

        $plan = Plan::create(['name' => 'Premium', 'url' => 'premium', 'price' => 199.99]);
        $plan->details()->create(['name' => 'Categoria']);
        $plan->details()->create(['name' => 'Produtos']);
        $plan->details()->create(['name' => 'Mesas']);
        $plan->details()->create(['name' => 'Cardápio']);
    }
}
