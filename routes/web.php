<?php

use App\DataTables\UsersDataTable;
use App\Events\UserRegistered;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Jobs\SendMail;
use App\Mail\PostPublished;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

Route::get('/dashboard', function (UsersDataTable $dataTable) {
    return $dataTable->render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/posts/trash', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::get('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.force_delete');
    Route::resource('posts', PostController::class);
});

Route::get('send-mail', function () {
    SendMail::dispatch();
    dd('Email was sent');
});

Route::get('user-register', function () {
    event(new UserRegistered());
    dd('message sent');
});

Route::get('create-role', function () {
    // $role = Role::create(['name' => 'publisher']);
    // return $role;
    // $permission = Permission::create(['name' => 'edit articles']);
    // return $permission;
    $user = auth()->user();
    // $user->assignRole('writer');
    // $user->givePermissionTo('edit articles');
    return $user->getPermissionNames();
});
