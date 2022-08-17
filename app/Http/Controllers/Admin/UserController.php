<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;
    public function __construct(User $user)
    {
        $this->repository = $user;
    }

    public function index()
    {
        $users = $this->repository->latest()
            ->tenantFilter()
            ->paginate();
        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => []
        ]);
    }
    public function create()
    {
        return view('admin.pages.users.create');
    }
    public function store(StoreUpdateUser $request)
    {
        $data = $request->except(['_token']);
        $data['tenant_id'] = auth()->user()->tenant_id;

        $this->repository->create($data);
        return redirect()->route('users.index');
    }
    public function show($uuid)
    {
        $user = $this->repository->where('uuid', $uuid)->first();
        if (!$user) {
            return redirect()->back();
        }
        return view('admin.pages.users.show', ['user' => $user]);
    }
    public function destroy($uuid)
    {
        $user = $this->repository->where('uuid', $uuid)->first();
        if (!$user) {
            return redirect()->back();
        }
        $user->delete();
        return redirect()->route('users.index');
    }
    public function edit($uuid)
    {
        $user = $this->repository->where('uuid', $uuid)->first();
        if (!$user) {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', ['user' => $user]);
    }
    public function update(StoreUpdateUser $request, $uuid)
    {



        $data = $request->except(['_token', '_method']);

        $user = $this->repository->where('uuid', $uuid)->first();
        if (!$user) {
            return redirect()->back();
        }
        $user->update($data);
        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters
        ]);
    }
}
