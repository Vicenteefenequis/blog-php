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

$baseUrl = 'gateway.docker.internal:8000/api';

Route::get('/', function () {
    return view('layouts/app');
});


Route::get('/posts', function () use ($baseUrl) {
    $response = \Illuminate\Support\Facades\Http::acceptJson()->get($baseUrl . '/posts')->json();
    list('data' => $posts,'links' => $links, 'meta' => $meta) = $response;

    return view('posts', [
        'posts' => $posts,
        'links' => $links,
        'meta' => $meta
    ]);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

