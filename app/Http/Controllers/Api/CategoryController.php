<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAllCategory()
    {
        return new CategoryCollection($this->categoryService->getAllCategory(), "success", "List Data Category");
    }

    public function getCategoryDetail($category_id)
    {
        return $this->categoryResponse($this->categoryService->getDetailCategory($category_id), "success", "Data found");
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->saveCategory($request->validated());
        return $this->categoryResponse($category, "success", "Data stored");
    }

    public function edit(CategoryRequest $request, $category_id)
    {
        $category = $this->categoryService->updateCategory($request->validated(), $category_id);
        return $this->categoryResponse($category, "success", "Category updated successfully");
    }

    public function delete($id)
    {
        $category = $this->categoryService->deleteCategory($id);
        return $this->categoryResponse($category, "success", "Category deleted successfully");
    }

    public function categoryResponse($category, $status, $message)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => new CategoryResource($category)
        ]);
    }
}
