<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllProduct();
    public function getProductById($id);
    public function createProduct(array $productDetails, $image);
    public function updateProduct(array $newDetails, $id, $image);
    public function deleteProduct($id);
}