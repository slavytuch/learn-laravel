<?php

use App\Enum\Abilities;
use App\Enum\Roles;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CurrentUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name(
            'logout'
        );
    });

    Route::controller(CurrentUserController::class)->group(function () {
        Route::get('/me', 'index');
        Route::post('/me', 'update');
    });


    Route::group(
        [
            'prefix' => 'admin',
            'as' => 'admin.',
            'middleware' => ['ability:'.Roles::Admin->value]
        ],
        function () {
            Route::apiResources([
                'roles' => RoleController::class,
                'users' => UserController::class,
            ]);
        }
    );

    Route::group([
        'prefix' => 'products.manager',
        'as' => 'products.manager',
        'controller' => ProductController::class,
    ], function () {
        Route::get('/', 'index')->middleware(
            'ability:'.Abilities::ViewProducts->value
        );
        Route::post('/', 'store')->middleware(
            'ability:'.Abilities::AddProducts->value
        );
        Route::get('/{id}', 'show')->middleware(
            'ability:'.Abilities::ViewProducts->value
        );
        Route::get('/list', 'index')->middleware(
            'ability:'.Abilities::ViewProducts->value
        );
    });

    Route::apiResource('basket', BasketController::class);
});


Route::apiResource('products', ProductController::class)->except(
    ['show', 'update', 'destroy']
);

Route::apiResource('product', ProductController::class)->only(['show']);

Route::get('products/{filter}/', [ProductController::class, 'filteredList']);

Route::any('test', function () {
    $query = Product::whereHas('properties', function ($property) {
        $property = $property->where([
            ['code', '=', 'test'],
            ['value', '>', '5000']
        ]);

    });
    $query = $query->whereHas('properties', function ($property) {
        $property->where([
            ['code', '=', 'width'],
            ['value', '<', '3000']
        ]);
    });
    return new ProductCollection(
        $query->get()
    );
});
