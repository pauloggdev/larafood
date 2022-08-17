<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $repository;
    public function __construct(Product $product)
    {

        $this->repository = $product;
    }

    public function index()
    {
        $products = $this->repository->latest()
            ->paginate();

        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $data = $request->except(['_token']);

        $tenant = auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }
        $data['tenant_id'] = auth()->user()->tenant_id;
        $this->repository->create($data);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $product = $this->repository->where('uuid', $uuid)->first();

        if (!$product) {
            return redirect()->back();
        }
        return view('admin.pages.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $product = $this->repository->where('uuid', $uuid)->first();

        if (!$product) {
            return redirect()->back();
        }
        return view('admin.pages.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {

        $data = $request->except(['_token', '_method']);

        $product = $this->repository->where('uuid', $uuid)->first();
        if (!$product) {
            return redirect()->back();
        }
        $tenant = auth()->user()->tenant;

        if ($request->hasFile('image') && $request->image->isValid()) {
            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }
        $product->update($data);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $product = $this->repository->where('uuid', $uuid)->first();
        if (!$product) {
            return redirect()->back();
        }
        if (Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index');
    }
}
