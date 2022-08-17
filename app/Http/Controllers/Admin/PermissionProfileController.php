<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    private $profile;
    private $permission;
    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->where('id', $idProfile)->first();
        if (!$profile) {
            return redirect()->back();
        }
        $permissions = $profile->permissions()->paginate();
        return view('admin.pages.profils.permissions.permissions', [
            'profile' => $profile,
            'permissions' => $permissions,
            'filters' => []
        ]);
    }
    public function profiles($permissionId){

        $permission = $this->permission->where('id', $permissionId)->first();
        if (!$permission) {
            return redirect()->back();
        }
        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', [
            'profiles' => $profiles,
            'permission' => $permission,
            'filters' => []
        ]);


    }
    public function permissionsDisponivel(Request $request, int $idProfile)
    {

        $profile = $this->profile->where('id', $idProfile)->first();
        if (!$profile) {
            return redirect()->back();
        }

        $request->except('_token');

        $permissions = $profile->permissionDisponivel($request->filter);
        return view('admin.pages.profils.permissions.available', [
            'profile' => $profile,
            'permissions' => $permissions,
            'filters' => []
        ]);
    }
    public function filterPermissionsDisponivel()
    {
    }
    public function attach(Request $request, $idProfile)
    {

        $profile = $this->profile->where('id', $idProfile)->first();
        if (!$profile) {
            return redirect()->back();
        }
        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()->with('info', 'Precisa escolher pelo menos uma permissão');
        }
        $profile->permissions()->attach($request->permissions);
        return redirect()->route('profil.permissions', $profile->id);
    }
    public function detach($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back();
        }
        $profile->permissions()->detach($permission);
        return redirect()->route('profil.permissions', $profile->id);
    }
    public function detachProfile($permissionId, $profileId){

        $permission = $this->permission->find($permissionId);
        $profile = $this->profile->find($profileId);

        if (!$profile || !$permission) {
            return redirect()->back();
        }
        $permission->profiles()->detach($profile);
        return redirect()->route('permission.profiles', $permission->id);

    }
}
