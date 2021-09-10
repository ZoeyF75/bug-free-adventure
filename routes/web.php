<?php

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
    return view('posts');
});

Route::get('posts/{post}', function ($slug) { //wrapped in braces is wildcard, similar to template literal in js
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if (!file_exists($path)) {
        //dd('file does not exist'); //kills execution and dumps something to page
        //ddd similar to dd but with typical error page
        return redirect('/');
    }

    $post = cache()->remember("posts.slug", 3600, fn() => file_get_contents($path));

    return view('post', ['post' => $post]);

})->where('post','[A-z_\-]+'); //find one or more of an uppercase or lowercase letter
