<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    private $category;
    private $product;
    public function __construct(Product $product, Category $category)
    {
        $this->category = $category;
        $this->product = $product;
    }


    public function categories($productUuid)
    {

        $product = $this->product->where('uuid', $productUuid)->first();
        if (!$product) {
            return redirect()->back();
        }
        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', [
            'categories' => $categories,
            'product' => $product,
            'filters' => []
        ]);
    }
    public function attach(Request $request, $productUuid)
    {


        $product = $this->product->where('uuid', $productUuid)->first();
        if (!$product) {
            return redirect()->back();
        }

        if (!$request->categories || count($request->categories) == 0) {
            return redirect()->back()->with('info', 'Precisa escolher pelo menos uma categoria');
        }
        $product->categories()->attach($request->categories);
        return redirect()->route('product.categories', $product->uuid);
    }
    public function detachProductCategory($categoryId, $productUuid){

        
        $product = $this->product->where('uuid', $productUuid)->first();
        $category = $this->category->where('id',$categoryId)->first();

        if (!$product || !$category) {
            return redirect()->back();
        }
        $category->products()->detach($product);
        return redirect()->route('category.products', $category->id);

    }
    public function detach($productUuid, $categoryId)
    {

        $product = $this->product->where('uuid', $productUuid)->first();
        $category = $this->category->where('id',$categoryId)->first();

        if (!$product || !$category) {
            return redirect()->back();
        }
        $product->categories()->detach($category);
        return redirect()->route('product.categories', $product->uuid);
    }
    public function categoriesAvailable(Request $request, $productUuid)
    {

        $product = $this->product->where('uuid', $productUuid)->first();
        if (!$product) {
            return redirect()->back();
        }

        $categories = $product->categoryAvailable();

        return view('admin.pages.products.categories.available', [
            'product' => $product,
            'categories' => $categories,
            'filters' => []
        ]);
    }
    public function productsAvailable(Request $request, $categoryId)
    {


        $category = $this->category->where('id', $categoryId)->first();
        if (!$category) {
            return redirect()->back();
        }

        $products = $category->productsAvailable();

        return view('admin.pages.categories.products.available', [
            'category' => $category,
            'products' => $products,
            'filters' => []
        ]);
    }

    public function products($categoryId)
    {

        $category = $this->category->where('id', $categoryId)->first();
        if (!$category) {
            return redirect()->back();
        }
        $products = $category->products()->paginate();
        

        return view('admin.pages.categories.products.products', [
            'products' => $products,
            'category' => $category,
            'filters' => []
        ]);
    }
}
