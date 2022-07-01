<?php
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

use APP\Models\User;



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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//Catagory Route 

Route::get('/catagory/all',[ CatagoryController::class, 'AllCat' ])->name('all.catagory');
Route::post('/catagory/add',[ CatagoryController::class, 'AddCat' ])->name('store.catagory');

Route::get('/catagory/edit/{id}',[ CatagoryController::class, 'Edit' ]);
Route::post('/catagory/update{id}',[ CatagoryController::class, 'Update' ]);
Route::get('/softdelete/catagory/{id}',[ CatagoryController::class, 'SoftDelete' ]);
Route::get('/catagory/restore/{id}',[ CatagoryController::class, 'Restore' ]);
Route::get('/pdelete/catagory/{id}',[ CatagoryController::class, 'pdelete' ]);


//Brand Route 

Route::get('/brand/all',[ BrandController::class, 'AllBrand' ])->name('all.brand');
Route::post('/brand/add',[ BrandController::class, 'StoreBrand' ])->name('store.brand');
Route::get('/brand/edit/{id}',[ BrandController::class, 'Edit' ]);
Route::post('/brand/update{id}',[ BrandController::class, 'Update' ]);
Route::get('/brand/delete/{id}',[ BrandController::class, 'Delete' ]);

// Multi Image Route

Route::get('/multi/image',[ BrandController::class, 'MultiPic' ])->name('multi.image');
Route::post('/multi/add',[ BrandController::class, 'StoreImage' ])->name('store.image');


Route::get('/', function () {
    return view('welcome');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('admin.index');
    })->name('admin.index');
});
