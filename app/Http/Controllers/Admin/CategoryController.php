<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $repository;
    public function __construct(Category $category)
    {

        $this->repository = $category;
    }

    public function index()
    {
        $categories = $this->repository->latest()
            ->tenantFilter()
            ->paginate();

        return view('admin.pages.categories.index', [
            'categories' => $categories,
            'filters' => []
        ]);
    }
    public function create()
    {

        return view('admin.pages.categories.create');
    }
    public function store(StoreUpdateCategory $request)
    {

        $data = $request->except(['_token']);
        $data['tenant_id'] = auth()->user()->tenant_id;
        $this->repository->create($data);
        return redirect()->route('categories.index');
    }
    public function show($url)
    {
        $category = $this->repository->where('url', $url)->first();
        if (!$category) {
            return redirect()->back();
        }
        return view('admin.pages.categories.show', ['category' => $category]);
    }
    public function destroy($url)
    {
        $category = $this->repository->where('url', $url)->first();
        if (!$category) {
            return redirect()->back();
        }
        $category->delete();
        return redirect()->route('categories.index');
    }
    public function edit($url)
    {
        $category = $this->repository->where('url', $url)->first();

        if (!$category) {
            return redirect()->back();
        }

        return view('admin.pages.categories.edit', ['category' => $category]);
    }
    public function update(StoreUpdateCategory $request, $url)
    {

        $data = $request->except(['_token', '_method']);

        $category = $this->repository->where('url', $url)->first();
        if (!$category) {
            return redirect()->back();
        }
        $category->update($data);
        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $categories = $this->repository->search($request->filter);

        return view('admin.pages.categories.index', [
            'categories' => $categories,
            'filters' => $filters
        ]);
    }
}
