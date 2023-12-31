<?php
use App\Http\Controllers\PartsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Imports\PartsImport;
use App\Exports\PartsExport;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
    return view('beranda');
});

Auth::routes();

Route::resource('parts', PartsController::class);
Route::resource('user', UserController::class);
Route::get('/beranda', [MenuController::class, 'home']);
Route::get('/manajemen-user', [MenuController::class,'manajemen_users']);
Route::get('/change-password', [MenuController::class,'change_password']);

Route::get('/search', [PartsController::class, 'search'])->name('search');
Route::get('/search2', [UserController::class, 'search2'])->name('search2');

Route::get('password/edit', [UpdatePasswordController::class, 'edit'])->name('password.edit');
Route::put('password/edit', [UpdatePasswordController::class, 'update']);


//sett delete all...
Route::delete('parts/{id}',[PartsController::class, 'destroy']);
Route::delete('partsDeleteAll',[PartsController::class, 'deleteAll']);
Route::delete('user/{id}',[UserController::class, 'destroy']);
Route::delete('userDeleteAll',[UserController::class, 'deleteAll']);

Route::post('import', function () {
    
    $fileName = time().'_'.request()->file->getClientOriginalName();
    request()->file('file')->storeAs('reports', $fileName, 'public');
    
    Excel::import(new PartsImport, request()->file('file'));
    return redirect()->back()->with('success','Data Imported Successfully');
});

Route::get('export', function () {
    return Excel::download(new PartsExport, 'partsList.csv');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
