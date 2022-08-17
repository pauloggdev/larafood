<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    private $repository;
    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }

    public function index()
    {
        $permissions = $this->repository->latest()->paginate();
        return view('admin.pages.permissions.index', [
            'permissions' => $permissions,
            'filters' => []
        ]);
    }


    public function create()
    {
        return view('admin.pages.permissions.create');

    }

    public function store(Request $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('permissions.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permission = $this->repository->where('id', $id)->first();
        if (!$permission) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.edit', ['permission' => $permission]);
    }

    public function update(Request $request, $id)
    {
        $mensagem = [
            'name.required' => 'Nome é obrigatorio'
        ];

        $request->validate([
            'name' => "required|min:3|max:255|unique:profiles,name,{$id},id",
            'description' => 'nullable|min:3|max:255'
        ], $mensagem);

        $data = $request->except(['_token', '_method']);

        $permission = $this->repository->where('id', $id)->first();
        if (!$permission) {
            return redirect()->back();
        }
        $permission->update($data);
        return redirect()->route('permissions.index');
    }

    public function destroy($id)
    {
        $permission = $this->repository->where('id', $id)->first();
        if (!$permission) {
            return redirect()->back();
        }
        $permission->delete();
        return redirect()->route('permissions.index');
    }
    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $permissions = $this->repository->search($request->filter);

        return view('admin.pages.permissions.index', [
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }
}
