<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllProduct();
    public function getProductById($id);
    public function createProduct(array $productDetails);
    public function updateProduct(array $newDetails, $id);
    public function deleteProduct($id);
}