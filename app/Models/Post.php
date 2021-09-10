<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File; //static access to all sorts of functionality

class Post
{
  public static function all()
  {
    $files = File::files(resource_path("posts/"));

    return array_map(fn($file) => $file->getContents(), $files);
  }

  public static function find($slug)
  {
    if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
      throw new ModelNotFoundException();
    }

    return $post = cache()->remember("posts.slug", 3600, fn() => file_get_contents($path));
  }
}