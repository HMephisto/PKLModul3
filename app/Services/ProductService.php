<?php

namespace App\Services;

use App\Helper\ImageHelper;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Arr;

class ProductService
{
    private $productRepo;
    private $imageHelper;

    public function __construct(ProductRepositoryInterface $productRepo, ImageHelper $imageHelper)
    {
        $this->productRepo = $productRepo;
        $this->imageHelper = $imageHelper;
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
        if (Arr::exists($request, 'image')) {
            $image = $this->imageHelper->saveImage($request['image']);
            $request['image'] = $image;
        }
        return $this->productRepo->createProduct($request);
    }

    public function updateProduct($request, $id)
    {
        $productDetail = $this->productRepo->getProductById($id);
        if (Arr::exists($request, 'image')) {
            $image = $this->imageHelper->saveImage($request['image  ']);
            if ($productDetail->image != null) {
                $this->imageHelper->deleteImage($productDetail->image);
            }
            $request['image'] = $image;
        }
        return $this->productRepo->updateProduct($request, $id);
    }

    public function deleteProduct($id)
    {
        $productDetail = $this->productRepo->getProductById($id);
        if ($productDetail->image != null) {
            if ($this->imageHelper->deleteImage($productDetail->image)) {
            }
        }
        return $this->productRepo->deleteProduct($id);
    }
}
