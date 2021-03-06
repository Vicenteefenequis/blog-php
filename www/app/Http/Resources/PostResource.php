<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "photo_url" => stripslashes($this->photo_url),
            "description" => $this->description,
            "category" => Category::find($this->category_id),
            "user" => User::find($this->user_id),
        ];
    }
}
