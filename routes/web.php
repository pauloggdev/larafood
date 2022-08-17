<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionProfileController;
use App\Http\Controllers\Admin\PlanoController;
use App\Http\Controllers\Admin\PlanProfileController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Site\SiteController;



Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        Route::get('testAcl', function () {

            // return auth()->user()->permissions();

            dd(auth()->user()->hasPermission('cadastrar usuarios2'));
        });

        // Details Plans 
        Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
        Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');
        Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
        Route::put('plans/{url}/details/{id}/update', [DetailPlanController::class, 'update'])->name('details.plan.update');
        Route::get('plans/{url}/details/{id}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
        Route::get('plans/{url}/details/{id}/delete', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');


        // Routes Plans 
        Route::any('planos/search', [PlanoController::class, 'search'])->name('plans.search');
        Route::get('planos', [PlanoController::class, 'index'])->name('plans.index');
        Route::get('planos/create', [PlanoController::class, 'create'])->name('plans.create');
        Route::post('planos', [PlanoController::class, 'store'])->name('plans.store');
        Route::get('planos/{url}', [PlanoController::class, 'show'])->name('plans.show');
        Route::delete('planos/{url}', [PlanoController::class, 'destroy'])->name('plans.destroy');
        Route::get('plano/edit/{url}', [PlanoController::class, 'edit'])->name('plans.edit');
        Route::put('plano/update/{url}', [PlanoController::class, 'update'])->name('plans.update');
        Route::get('/', [PlanoController::class, 'index'])->name('admin.index');

        //Users
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('user/edit/{uuid}', [UserController::class, 'edit'])->name('users.edit');
        Route::delete('user/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('user/details/{uuid}', [UserController::class, 'show'])->name('users.show');
        Route::put('user/update/{uuid}', [UserController::class, 'update'])->name('users.update');
        Route::get('user/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users/create', [UserController::class, 'store'])->name('users.store');
        Route::any('users/search', [UserController::class, 'search'])->name('users.search');

        //Categories
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('category/edit/{url}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::delete('category/{url}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('category/details/{url}', [CategoryController::class, 'show'])->name('categories.show');
        Route::put('category/update/{url}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('category/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories/create', [CategoryController::class, 'store'])->name('categories.store');
        Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
        Route::get('category/{id}/products', [CategoryController::class, 'products'])->name('category.products');

        //Mesas
        Route::get('tables', [TableController::class, 'index'])->name('tables.index');
        Route::get('table/edit/{uuid}', [TableController::class, 'edit'])->name('tables.edit');
        Route::delete('table/{uuid}', [TableController::class, 'destroy'])->name('tables.destroy');
        Route::get('table/details/{uuid}', [TableController::class, 'show'])->name('tables.show');
        Route::put('table/update/{uuid}', [TableController::class, 'update'])->name('tables.update');
        Route::get('table/create', [TableController::class, 'create'])->name('tables.create');
        Route::post('table/create', [TableController::class, 'store'])->name('tables.store');
        Route::any('table/search', [TableController::class, 'search'])->name('tables.search');

        //Profile
        Route::get('perfis', [ProfileController::class, 'index'])->name('profils.index');
        Route::get('perfil/create', [ProfileController::class, 'create'])->name('profils.create');
        Route::post('perfils', [ProfileController::class, 'store'])->name('profils.store');
        Route::get('perfil/edit/{id}', [ProfileController::class, 'edit'])->name('profils.edit');
        Route::get('perfil/{id}', [ProfileController::class, 'show'])->name('profils.show');
        Route::put('perfil/update/{id}', [ProfileController::class, 'update'])->name('profils.update');
        Route::any('perfis/search', [ProfileController::class, 'search'])->name('profils.search');
        Route::delete('perfis/{url}', [ProfileController::class, 'destroy'])->name('profils.destroy');

        //persmission
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('permission/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('permission/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::get('permission/{id}', [PermissionController::class, 'show'])->name('permissions.show');
        Route::put('permission/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
        Route::delete('permissions/{url}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
        Route::get('permission/{id}/profiles', [PermissionProfileController::class, 'profiles'])->name('permission.profiles');
        Route::get('permission/{id}/profile/{idProfile}/detach', [PermissionProfileController::class, 'detachProfile'])->name('permission.profile.detachProfile');


        //PROFIL X PERMISSOES
        Route::get('profile/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profil.permissions');
        Route::any('profile/{id}/permissions/create', [PermissionProfileController::class, 'permissionsDisponivel'])->name('profil.permissions.available');
        Route::post('profile/{id}/permissions/store', [PermissionProfileController::class, 'attach'])->name('profil.permissions.attach');
        Route::get('profile/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detach'])->name('profil.permissions.detach');


        //PLAN X PROFILES
        Route::get('plan/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plan.profiles');
        Route::any('plan/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plan.profiles.available');
        Route::post('plan/{id}/profiles/store', [PlanProfileController::class, 'attach'])->name('plan.profiles.attach');
        Route::get('plan/{planId}/profile/{profileId}/detach', [PlanProfileController::class, 'detach'])->name('plan.profiles.detach');

        //PRODUCTS
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::get('product/edit/{uuid}', [ProductController::class, 'edit'])->name('products.edit');
        Route::delete('product/{uuid}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('product/details/{uuid}', [ProductController::class, 'show'])->name('products.show');
        Route::put('product/update/{uuid}', [ProductController::class, 'update'])->name('products.update');
        Route::get('product/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('products/create', [ProductController::class, 'store'])->name('products.store');
        Route::any('products/search', [ProductController::class, 'search'])->name('products.search');

        //PRODUCT X CATEGORIES
        Route::get('product/{uuid}/categories', [CategoryProductController::class, 'categories'])->name('product.categories');
        Route::get('category/{id}/products', [CategoryProductController::class, 'products'])->name('category.products');
        Route::any('product/{uuid}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('product.categories.available');
        Route::any('category/{id}/products/create', [CategoryProductController::class, 'productsAvailable'])->name('category.products.available');
        Route::post('product/{uuid}/categories/store', [CategoryProductController::class, 'attach'])->name('product.categories.attach');
        Route::get('product/{uuid}/category/{id}/detach', [CategoryProductController::class, 'detach'])->name('product.categories.detach');
        Route::get('category/{id}/product/{uuid}/detach', [CategoryProductController::class, 'detachProductCategory'])->name('category.products.detach');
    });


//SITE
Route::get('/plano/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
Route::get('/', [SiteController::class, 'index'])->name('site.index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
