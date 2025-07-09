<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\ApiResponse;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $user_id = Auth::id();
        $categories = Category::with('todos')->where('user_id', $user_id)->get();
        return $this->success('Categories retrived successfully', 200, CategoryResource::collection($categories));
    }

    public function show($id)
    {
        $user_id = Auth::id();
        $category = Category::with('todos')->where('user_id', $user_id)->where('id', $id)->firstOrFail();
        return $this->success('Category retrived successfully', 200, new CategoryResource($category));
    }

    public function store(AddCategoryRequest $request)
    {
        $user_id = Auth::id();
        $data = $request->validated();
        $data['user_id'] = $user_id;
        $category = Category::query()->create($data);
        return $this->success('Category added successfully', 201, new CategoryResource($category));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $user_id = Auth::id();
        $data = $request->validated();
        $data['user_id'] = $user_id;
        Category::query()->where('user_id', $user_id)->where('id', $id)->update($data);
        return $this->successMessage('Category updated successfully', 200);
    }

    public function destroy($id)
    {
        $user_id = Auth::id();
        $category = Category::query()->where('user_id', $user_id)->where('id', $id)->delete();
        return $this->successMessage('Category deleted successfully', 200);
    }
}
