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

    public function createProduct($productDetails)
    {
        $this->products::create($productDetails);
    }

    public function updateProduct($newDetails, $id)
    {
        $this->products::where('id', $id)->update($newDetails);
    }

    public function deleteProduct($id)
    {
        $this->products::where('id', $id)->delete();
    }
}