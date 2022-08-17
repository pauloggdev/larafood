<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;

class SiteController extends Controller
{

    public function index()
    {
        $plans = Plan::with('details')
            ->orderby('price', 'asc')
            ->get();

        return view('site.home.index', [
            'plans' => $plans
        ]);
    }

    public function plan($url)
    {
        $plan = Plan::where('url', $url)->first();
        if (!$plan) {
            return redirect()->back();
        }
        session()->put('plan', $plan);
        return redirect()->route('register');
    }
}
