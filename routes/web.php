<?php

use App\Models\Post;
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
    return view('posts', [
        'posts' =>  $posts //how to get those posts...
    ]);
});

//Find a post by its slug and pass it to a view called "post"
Route::get('posts/{post}', function ($slug) { //wrapped in braces is wildcard, similar to template literal in js
    return view('post', [
        'post' => Post::find($slug)
    ]);
})->where('post','[A-z_\-]+'); //find one or more of an uppercase or lowercase letter
