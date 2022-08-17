<?php

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();
        $tenant->users()->create([
            'name' => 'Mateuna',
            'email' => 'matuena@gmail.com',
            'password' => bcrypt('12345')
        ]);
    }
}
