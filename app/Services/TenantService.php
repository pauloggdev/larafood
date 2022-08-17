<?php

namespace App\Services;

use App\Models\Plan;


class TenantService
{

    private $plan;
    private $data = [];

    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();
        return $this->storeUser($tenant);
    }
    public function storeTenant()
    {
        $data = $this->data;
        return $this->plan->tenants()->create([
            'cnpj' => $data['cnpj'],
            'name' => $data['name'],
            'email' => $data['email'],
            'subscription' => now(),
            'expires_at' => now()->addDay(7)
        ]);
    }
    public function storeUser($tenant)
    {
        $user = $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt('12345')
        ]);
        return $user;
    }
}
