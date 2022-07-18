<?php
use App\Models\Multipic;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
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

// Admin All Route

Route::get('/home/slider',[ HomeController::class, 'HomeSlider' ])->name('home.slider');
Route::get('/add/slider',[ HomeController::class, 'AddSlider' ])->name('add.slider');
Route::post('/store/slider',[ HomeController::class, 'StoreSlider' ])->name('store.slider');
Route::get('/slider/edit/{id}',[ HomeController::class, 'EditSlider' ]);

//Home About All Route

Route::get('/home/about',[ AboutController::class, 'HomeAbout' ])->name('home.about');
Route::get('/add/homeabout',[ AboutController::class, 'AddAbout' ])->name('add.homeabout');
Route::post('/store/about',[ AboutController::class, 'StoreAbout' ])->name('store.about');
Route::get('/about/edit/{id}',[ AboutController::class, 'EditAbout' ]);
Route::post('/update/about{id}',[AboutController::class,'Update']);
Route::get('/about/delete/{id}',[ AboutController::class, 'Delete' ]);

//Portfolio Route
 
Route::get('/portfolio',[Aboutcontroller::class,'portfolio'])->name('portfolio');



//Admin  Contact 
Route::get('/admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact',[ContactController::class,'AdminAddContact'])->name('add.contact');
Route::post('/store/contact',[ ContactController::class, 'StoreContact' ])->name('store.contact');

//Contact Home Page route

Route::get('/contact',[ContactController::class,'Contact'])->name('contact');
Route::post('/contact/form',[ContactController::class,'ContactForm'])->name('contact.form');
Route::get('/Admin/message',[ContactController::class,'AdminMessage'])->name('admin.message');





Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home',compact('brands','abouts','images'));
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/user/logout',[ BrandController::class, 'Logout' ])->name('user.logout');


///change password and Profile Route

Route::get('/user/password',[ChangePass::class,'CPassword'])->name('change.password');

Route::post('/password/update',[ChangePass::class,'UpdatePassword'])->name('password.update');


//User Profile
Route::get('/Profile/Update',[ChangePass::class,'PUpdate'])->name('profile.update');
Route::post('User/Profile/Update',[ChangePass::class,'UpdateProfile'])->name('user.profile.update');