<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::create($request->all());

        return [
            "status" => 1,
            "data" => $category
        ];
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return [
            "status" => 1,
            "data" => $category,
            "msg" => "Category successfully updated"
        ];
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return [
            "status" => 1,
            "data" => $category,
            "msg" => "Category deleted successfully"
        ];
    }

    public function restore($id)
    {
        Category::withTrashed()->findOrFail($id)->restore();

        return [
            "status" => 1,
            "msg" => "Category restored successfully"
        ];
    }
}
