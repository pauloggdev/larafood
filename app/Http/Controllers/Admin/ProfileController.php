<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfil;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $repository;
    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }

    public function index()
    {
        $profils = $this->repository->latest()->paginate();
        return view('admin.pages.profils.index', [
            'profils' => $profils,
            'filters' => []
        ]);
    }
    public function edit($id)
    {
        $perfil = $this->repository->where('id', $id)->first();
        if (!$perfil) {
            return redirect()->back();
        }

        return view('admin.pages.profils.edit', ['perfil' => $perfil]);
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

        $perfil = $this->repository->where('id', $id)->first();
        if (!$perfil) {
            return redirect()->back();
        }
        $perfil->update($data);
        return redirect()->route('profils.index');
    }
    public function create()
    {
        return view('admin.pages.profils.create');
    }
    public function store(StoreUpdateProfil $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('profils.index');
    }
    public function destroy($id){

        $perfil = $this->repository->where('id', $id)->first();
        if (!$perfil) {
            return redirect()->back();
        }
        $perfil->delete();
        return redirect()->route('profils.index');
    
    }
    public function search(){

    }
}
