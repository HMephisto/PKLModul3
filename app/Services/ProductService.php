<?php
namespace App\Services;

use App\Models\Product;

class ProductService
{
    private $products;

    public function __construct()
    {
        $this->products = new Product();
    }

    public function getAllProduct()
    {
        return $this->products::orderBy("id", "ASC")->get();
    }

    public function getDetailProduct($id)
    {
        return $this->products::findorfail($id);
    }

    public function saveProduct($request)
    {
        $this->products::create($request);
    }

    public function updateProduct($request, $id)
    {
        $this->products::where('id', $id)->update($request);
    }

    public function deleteProduct($id)
    {
        $this->products::where('id', $id)->delete();
    }
}
