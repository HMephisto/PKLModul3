<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Traits\Tappable;

class ProductRepository implements ProductRepositoryInterface
{
    private $products;

    public function __construct()
    {
        $this->products = new Product();
    }

    public function getAllProduct()
    {
        return $this->products::all();
    }

    public function getProductById($id)
    {
        return $this->products::with("brand")->findorfail($id);
    }

    public function createProduct($productDetails)
    {
        return $this->products::create($productDetails);
        // return $this->products::create([
        //     "name" => $productDetails["name"],
        //     "price" => $productDetails["price"],
        //     "brand_id" => $productDetails["brand_id"],
        //     "image" => $imageName,
        // ]);
    }

    public function updateProduct($newDetails, $id)
    {
        return tap($this->products::findorfail($id))->update($newDetails);
        // return = tap($this->products)->update([
        //     "name" => $newDetails["name"],
        //     "price" => $newDetails["price"],
        //     "brand_id" => $newDetails["brand_id"],
        //     "image" => $newDetails["image"],
        // ]);
    }

    public function deleteProduct($id)
    {
        return tap($this->products::findorfail($id))->delete();
    }
}
