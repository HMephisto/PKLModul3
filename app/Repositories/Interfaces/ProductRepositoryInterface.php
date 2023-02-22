<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllProduct();
    public function getProductById($id);
    public function createProduct(array $productDetails);
    public function attachCategory($id, $cateegory_id);
    public function detachCategory($id, $cateegory_id);
    public function updateProduct(array $newDetails, $id);
    public function deleteProduct($id);
}