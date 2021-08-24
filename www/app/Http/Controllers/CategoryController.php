<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index() {
        return Category::all();
    }

    public function store(Request $request) {
        $validatedData = $this->validate($request, [
            "name" => "required|max:255",
        ]);

        $category = Category::create($validatedData);
        $category->refresh();
        return $category;
    }

    public function show($id) {
        return Category::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);

        $validatedData = $this->validate($request, [
            "name" => "required|max:255"
        ]);

        $category->update($validatedData);
        $category->refresh();
        return $category;
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->noContent();
    }


}
