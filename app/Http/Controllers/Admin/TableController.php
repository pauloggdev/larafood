<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTable;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $repository;
    public function __construct(Table $table)
    {

        $this->repository = $table;
    }

    public function index()
    {
        $tables = $this->repository->latest() ->paginate();

        return view('admin.pages.tables.index', [
            'tables' => $tables,
            'filters' => []
        ]);
    }
    public function create()
    {

        return view('admin.pages.tables.create');
    }
    public function store(StoreUpdateTable $request)
    {

        $data = $request->except(['_token']);
        $this->repository->create($data);
        return redirect()->route('tables.index');
    }
    public function show($uuid)
    {
        $table = $this->repository->where('uuid', $uuid)->first();
        if (!$table) {
            return redirect()->back();
        }
        return view('admin.pages.tables.show', ['table' => $table]);
    }
    public function destroy($uuid)
    {
        $table = $this->repository->where('uuid', $uuid)->first();
        if (!$table) {
            return redirect()->back();
        }
        $table->delete();
        return redirect()->route('tables.index');
    }
    public function edit($uuid)
    {
        $table = $this->repository->where('uuid', $uuid)->first();

        if (!$table) {
            return redirect()->back();
        }

        return view('admin.pages.tables.edit', ['table' => $table]);
    }
    public function update(StoreUpdateTable $request, $uuid)
    {

        $data = $request->except(['_token', '_method']);

        $table = $this->repository->where('uuid', $uuid)->first();
        if (!$table) {
            return redirect()->back();
        }
        $table->update($data);
        return redirect()->route('tables.index');
    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $tables = $this->repository->search($request->filter);

        return view('admin.pages.tables.index', [
            'tables' => $tables,
            'filters' => $filters
        ]);
    }
}
