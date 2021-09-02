<?php

use App\Http\Resources\PostResource;
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

$baseUrl = 'gateway.docker.internal:8000/api';


Route::get('/', function () {
    return view('layouts/app');
});


Route::get('/blog', function () use ($baseUrl) {
    $response = \Illuminate\Support\Facades\Http::acceptJson()->get($baseUrl . '/posts')->json();

    list('data' => $posts, 'links' => $links, 'meta' => $meta) = $response;

    return view('blog', [
        'posts' => toObject($posts),
        'links' => toObject($links),
        'meta' => toObject($meta)
    ]);

});

Route::get('/posts/{id}', function ($id) use ($baseUrl) {
    $response = \Illuminate\Support\Facades\Http::acceptJson()->get($baseUrl . '/posts/' . $id)->json();
    list('data' => $post) = $response;
    return view('post', [
        'post' => toObject($post)
    ]);

})->name('post');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


function toObject($data) {
    return json_decode(json_encode($data, JSON_FORCE_OBJECT));
}
