<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    private $profile;
    private $plan;
    public function __construct(Plan $plan, Profile $profile)
    {
        $this->profile = $profile;
        $this->plan = $plan;
    }


    public function profiles($planId)
    {

        $plan = $this->plan->where('id', $planId)->first();
        if (!$plan) {
            return redirect()->back();
        }
        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', [
            'profiles' => $profiles,
            'plan' => $plan,
            'filters' => []
        ]);
    }
    public function attach(Request $request, $planId)
    {


        $plan = $this->plan->where('id', $planId)->first();
        if (!$plan) {
            return redirect()->back();
        }
        if (!$request->profiles || count($request->profiles) == 0) {
            return redirect()->back()->with('info', 'Precisa escolher pelo menos um perfil');
        }
        $plan->profiles()->attach($request->profiles);
        return redirect()->route('plan.profiles', $plan->id);
    }
    public function detach($planId, $profileId)
    {

        $plan = $this->plan->find($planId);
        $profile = $this->profile->find($profileId);

        if (!$plan || !$profile) {
            return redirect()->back();
        }
        $plan->profiles()->detach($profile);
        return redirect()->route('plan.profiles', $plan->id);
    }
    public function profilesAvailable(Request $request, $planId)
    {

        $plan = $this->plan->where('id', $planId)->first();
        if (!$plan) {
            return redirect()->back();
        }

        $profiles = $plan->profileAvailable();

        return view('admin.pages.plans.profiles.available', [
            'plan' => $plan,
            'profiles' => $profiles,
            'filters' => []
        ]);
    }
}
