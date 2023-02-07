<?php
namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{
    private $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
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
        $this->productRepo->createProduct($request);
    }

    public function updateProduct($request, $id)
    {
        $this->productRepo->updateProduct($request, $id);
    }

    public function deleteProduct($id)
    {
        $this->productRepo->deleteProduct($id);
    }
}
