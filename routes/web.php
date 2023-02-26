<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckBoxController;
use App\Models\CheckBox;

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

Route::get('/', function ()
 {
    $checkbox_lables = CheckBox::all();
    return view('welcome')->with(['checkbox_lables'=>$checkbox_lables]); 
}); 

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


 
Route::group([ 'middleware' => 'auth'], function () {
    // Route::resource('checkbox', CheckboxController::class);

    Route::get('checkbox/create',[App\Http\Controllers\CheckboxController::class, 'create']);
    Route::post('checkbox/store',[App\Http\Controllers\CheckboxController::class, 'store']);
    Route::get('checkbox/destroy/{id}',[App\Http\Controllers\CheckboxController::class, 'destroy']);

    Route::post('get_checkbox_list',[App\Http\Controllers\CheckboxController::class, 'get_checkbox_list']);
    Route::post('update_checkbox',[App\Http\Controllers\CheckboxController::class, 'update_checkbox']);

});
