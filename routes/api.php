<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(
    [
    'prefix'=>'categories',
    'controller'=>CategoryController::class
    ],
    function(){
        Route::get('','index');
        Route::post('store','store');
        Route::post('update/{id}','update');
        Route::delete('{id}','delete');
    });



    Route::group(
        [
        'prefix'=>'products',
        'controller'=>ProductController::class
        ],
        function(){
            Route::get('','index');
            Route::post('store','store');
            Route::post('update/{id}','update');
            Route::delete('{id}','delete');
        });

