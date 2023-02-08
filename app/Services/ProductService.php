<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Arr;

class ProductService
{
    private $productRepo;
    private $imageService;

    public function __construct(ProductRepositoryInterface $productRepo, ImageService $imageService)
    {
        $this->productRepo = $productRepo;
        $this->imageService = $imageService;
    }

    public function getAllProduct()
    {
        return $this->productRepo->getAllProduct();
    }

    public function getDetailProduct($id)
    {
        return $this->productRepo->getProductById($id);
    }

    public function saveProduct($request)
    {
        $image = null;
        if (Arr::exists($request, 'image')) {
            $image = $this->imageService->saveImage($request['image']);
        }
        $this->productRepo->createProduct($request, $image);
    }

    public function updateProduct($request, $id)
    {
        $productDetail = $this->productRepo->getProductById($id);
        $image = $productDetail->image;
        if (Arr::exists($request, 'image')) {
            $image = $this->imageService->saveImage($request['image']);
            if ($productDetail->image != null) {
                $this->imageService->deleteImage($productDetail->image);
            }
        }
        $this->productRepo->updateProduct($request, $id, $image);
    }

    public function deleteProduct($id)
    {
        $productDetail = $this->productRepo->getProductById($id);
        if ($this->imageService->deleteImage($productDetail->image)) {
            $this->productRepo->deleteProduct($id);
        }
    }
}
