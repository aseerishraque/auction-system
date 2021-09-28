<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $status     = $categories->count() ? true : false;

        return response()->json([
            'categories' => $categories,
            'status'     => $status,
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated() +
            ['slug' => Str::slug($request->validated()['name'])]
        );

        $status = $category ? true : false;

        return response()->json([
            'category' => $category,
            'status'   => $status,
            'message'  => 'Category Added Successfully.',
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $status = $category->update($request->validated() + ['slug' => Str::slug($request->validated()['name'])]);

        return response()->json([
            'status' => $status,
        ]);
    }
}
