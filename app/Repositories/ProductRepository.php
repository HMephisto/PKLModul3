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
        return $this->products::with(["brand", "categories"])->paginate();
    }

    public function getProductById($id)
    {
        return $this->products::with(["brand", "categories"])->findorfail($id);
    }

    public function searchProduct($name)
    {
        return $this->products::where("name", "ilike", "%".$name."%")->with(["brand", "categories"])->paginate();
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

    public function attachCategory($id, $cateegory_id)
    {
        $product = $this->products::findorfail($id);

        $product->categories()->attach($cateegory_id);
    }

    public function detachCategory($id, $cateegory_id)
    {
        $product = $this->products::findorfail($id);

        $product->categories()->detach($cateegory_id);
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
