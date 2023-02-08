<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    private $products;

    public function __construct()
    {
        $this->products = new Product();
    }

    public function getAllProduct()
    {
        return $this->products::oldest("id")->with("brand")->get();
    }

    public function getProductById($id)
    {
        return $this->products::with("brand")->findorfail($id);
    }

    public function createProduct($productDetails, $imageName)
    {
        $this->products::create([
            "name" => $productDetails["name"],
            "price" => $productDetails["price"],
            "brand_id" => $productDetails["brand_id"],
            "image" => $imageName,
        ]);
    }

    public function updateProduct($newDetails, $id, $imageName)
    {
        $this->products::findorfail($id)->update([
            "name" => $newDetails["name"],
            "price" => $newDetails["price"],
            "brand_id" => $newDetails["brand_id"],
            "image" => $imageName,
        ]);
    }

    public function deleteProduct($id)
    {
        return $this->products::findorfail($id)->delete();
    }
}
