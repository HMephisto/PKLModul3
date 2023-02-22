<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UploadFileRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAllProduct()
    {
        return new ProductCollection($this->productService->getAllProduct(), "success", "List Data Product");
    }

    public function getProductDetail($product_id)
    {
        return $this->productResponse($this->productService->getDetailProduct($product_id), "success", "Data found");
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->saveProduct($request->validated());
        return $this->productResponse($product, "success", "Data stored");
    }

    public function edit(ProductRequest $request, $product_id)
    {
        $product = $this->productService->updateProduct($request->validated(), $product_id);
        return $this->productResponse($product, "success", "Product updated successfully");
    }

    public function delete($id)
    {
        $product = $this->productService->deleteProduct($id);
        return $this->productResponse($product, "success", "Product deleted successfully");
    }

    public function uploadFile(UploadFileRequest $request)
    {
        $filename = $this->productService->uploadFile($request);
        return response()->json([
            "status" => "success",
            "message" => "Upload success",
            "data" => [
                "filename" => $filename
            ]
        ]);
    }

    public function addCategory(ProductCategoryRequest $request)
    {
        $this->productService->addCategory($request->validated());
        return response()->json([
            "status" => "success",
            "message" => "Category added successfully",
        ]);
    }
    
    public function removeCategory(ProductCategoryRequest $request)
    {
        $this->productService->removeCategory($request->validated());
        return response()->json([
            "status" => "success",
            "message" => "Category removed successfully",
        ]);
    }

    public function productResponse($product, $status, $message)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => new ProductResource($product)
        ]);
    }
}
