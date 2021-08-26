<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        $users = User::all();
        \App\Models\Post::factory(25)->create()->each(function (Post $post) use($categories,$users){
           /** @var Category $category */
           $category = $categories->random(1)->first();

           $user = $users->random(1)->first();

           $post->category()->associate($category);
           $post->user()->associate($user);
           $post->save();
        });
    }
}
