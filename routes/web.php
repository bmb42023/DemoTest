<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;

//use Faker\Provider\UserAgent;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [UserController::class, 
'Index'])->name('index');


Route::get('/dashboard', function () {
   // return view('dashboard');
   return view('frontend.dashboard.index');

})->middleware(['auth', 'verified'])->name('dashboard');

// This is defualt we donot need make custom
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class,'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class,'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class,'UserChangePassword'])->name('user.change.password');
    Route::post('/user/change/password/update', [UserController::class,'UserPasswordUpdate'])->name('user.password.update');
    //    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 });


require __DIR__.'/auth.php';

// Admin Group middleware
// admin Group Middleware 
Route::middleware('auth','roles:admin')->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 
    'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 
    'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 
    'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 
    'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 
    'AdminChangePassword'])->name('admin.change.password');
    //Route::post('/admin/change/password', [AdminController::class, 
    // AdminChangePasswordSubmit'])->name('admin.change.password.Submit');
    Route::get('/admin/password/updateForm', [AdminController::class, 
    'AdminPasswordUpdateForm'])->name('admin.password.updateform');

    Route::post('/admin/password/update', [AdminController::class, 
    'AdminPasswordUpdate'])->name('admin.password.update');
    

   Route::controller(CategoryController::class)->group(function(){
    Route::get('/all/category','AllCategory')->name('all.category');
    Route::get('/add/category','AddCategory')->name('add.category'); 
   // Route::get('/store/category','AddCategoryForm')->name('add.category'); 
    Route::post('/store/category','StoreCategory')->name('store.category');
   });
//  aLL routes for instrucror

   Route::controller(AdminController::class)->group(function(){
    Route::get('/all/instructor','Allinstructor')->name('all.instructor');
    Route::post('/update/user/statis','UpdateUserStatus')->name('update.user.status');
});


   // Route::get('/admin/change/password', [AdminController::class, 
   // 'AdminChangePassword'])->name('admin.change.password');
    


});
//End of admin group
Route::get('/admin/login', [AdminController::class, 
'AdminLogin'])->name('admin.login');
// This mean u access  wtihout login 
Route::get('/became/instructor', [AdminController::class, 
'BecameInstructor'])->name('became.instructor');
Route::post('/instructor/register', [AdminController::class, 
'InstructorRegister'])->name('instructor.register');



Route::get('/admin/profile', [AdminController::class, 
'AdminProfile'])->name('admin.profile');
// instructor Group Middleware  
Route::middleware('auth','roles:instructor')->group(function(){
    Route::get('/instructor/dashboard', [InstructorController::class, 
    'Instructorboard'])->name('instructor.dashboard');
    Route::get('/instructor/logout', [InstructorController::class, 
    'InstructorLogout'])->name('instructor.logout');
    Route::get('/instructor/Profile', [InstructorController::class, 
    'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/Profile/store', [InstructorController::class, 
    'InstructorProfileStore'])->name('instructor.profile.store');
    Route::get('/instructor/change/password', [InstructorController::class, 
    'InstructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor/password/update', [InstructorController::class, 
    'InstructorPasswordUpdate'])->name('instructor.password.update');


   
});
//End of instructor group
Route::get('/instructor/login', [InstructorController::class, 
'InstructorLogin'])->name('instructor.login');




Route::get('/user/dashboard', [UserController::class, 'Userboard'])->name('user.dashboard');


