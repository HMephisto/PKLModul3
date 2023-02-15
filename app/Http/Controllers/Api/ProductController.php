<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
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

    public function getAllProduct(): ProductCollection
    {
        return new ProductCollection($this->productService->getAllProduct());
    }

    public function getProductDetail($product_id): ProductResource
    {
        return $this->productResponse($this->productService->getDetailProduct($product_id));
    }

    public function store(ProductRequest $request): ProductResource
    {
        $product = $this->productService->saveProduct($request->validated());
        return $this->productResponse($product);
    }

    public function edit(ProductRequest $request, $product_id): ProductResource
    {
        $product = $this->productService->updateProduct($request->validated(), $product_id);
        return $this->productResponse($product);
    }

    public function delete($id): ProductResource
    {
        $product = $this->productService->deleteProduct($id);
        return $this->productResponse($product);
    }

    public function productResponse($product): ProductResource
    {
        return new ProductResource($product);
    }
}
