<?php

use App\Http\Controllers\PostController;
use App\Mail\OrderShipped;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
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
});

Route::group(["middleware" => "authCheck2"], function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    });

    Route::get('/profile', function () {
        return view('profile');
    });
});



Route::get('posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::get('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.force_delete');

Route::resource('posts', PostController::class);

Route::get('/unavailable', function () {
    return view('unavailable');
})->name('unavailable');

Route::get('contact', function () {
    $posts = Post::all();
    return view('contact', compact('posts'));
})->name('contact');

Route::get('send-mail', function () {
    // Mail::raw('Hallo makker dit is een test mail', function ($message) {
    //     $message->to('jemuelvalpoort10@gmail.com')->subject('Test mail vanuit Laravel');
    // });
    Mail::send(new OrderShipped);
    dd("Success");
});

Route::get('get-session', function (Request $request) {
    $data = session()->all();
    // $data = $request->session()->all();
    // $data = $request->session()->get('_token');
    dd($data);
});

Route::get('save-session', function (Request $request) {
    session(['user_id' => '123']);
    $request->session()->put('user_status', 'logged_in');
    session(['user_ip' => '123.23.11']);
    return redirect('get-session');
});

Route::get('delete-session', function (Request $request) {
    // $request->session()->forget('user_ip');
    session()->forget(['user_ip', 'user_id']);
    return redirect('get-session');
});

Route::get('flash-session', function (Request $request) {
    $request->session()->flash('status', 'true');
    return redirect('get-session');
});
