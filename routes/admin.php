<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Builder\Function_;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['role:admin']], function () {
    //
});

Route::get('/',  function() {
    return view('layouts.backend');

}
);

Route::resource('/category',\App\Http\Controllers\CategoryController::class,['name'=>'category']);



