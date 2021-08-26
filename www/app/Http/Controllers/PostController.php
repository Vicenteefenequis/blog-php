<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    private $paginationSize = 15;

    public function index() {
        return PostResource::collection(Post::paginate($this->paginationSize));
    }

    public function store(Request $request) {

        $validatedData = $this->validate($request, [
            "title" => "required|max:255",
            "description" => "string",
            "category_id" => "required|exists:categories,id",
        ]);

        $user = ["user_id" => Auth::user()->id];


        $post = Post::create($validatedData + $user);
        $post->refresh();
        return $post;
    }

    public function show($id) {
        return new PostResource(Post::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);

        $validatedData = $this->validate($request, [
            'title' => 'string',
            'description' => 'string',
        ]);

        $post->update($validatedData);
        $post->refresh();
        return $post;
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->noContent();
    }

}
