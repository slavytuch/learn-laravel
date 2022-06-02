<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSectionController;
use App\Models\Product;
use App\Models\ProductSection;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/products', function (){
    var_dump('products');
    echo '<pre>';
    foreach (ProductSection::query()
                 ->whereDoesntHave('parent')
                 ->withCount('products')
                 ->get() as $section
    ) {
        echo $section->name . ' (' . $section->costlyProducts->count() . ')' . '<br>';
        foreach ($section->costlyProducts as $product) {
            print_r($product->toArray());
        }
        foreach ($section->children as $childSection) {
            $childSection->loadCount('products');
            echo $childSection->name . ' (' . $childSection->costlyProducts->count() . ')' . '<br>';
            foreach ($childSection->costlyProducts as $product) {
                print_r($product->toArray());
            }
        }
    }
    echo '</pre>';
});
