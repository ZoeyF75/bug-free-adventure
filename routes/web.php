<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;

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
    $files = File::files(resource_path("posts"));
    $posts = [];

    foreach($files as $file) {
        $document = YamlFrontMatter::parseFile($file);
        $posts[] = new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body()
        );
    }
    ddd($posts);
});

//Find a post by its slug and pass it to a view called "post"
Route::get('posts/{post}', function ($slug) { //wrapped in braces is wildcard, similar to template literal in js
    return view('post', [
        'post' => Post::find($slug)
    ]);
})->where('post','[A-z_\-]+'); //find one or more of an uppercase or lowercase letter
