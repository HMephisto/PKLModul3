<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function showHome()
    {
        return view('home', ["products" => $this->productService->getAllProduct()]);
    }
    public function store(ProductRequest $request)
    {
        $this->productService->saveProduct($request->validated());
        return redirect()->route('home')->with("success", "Data was successfully added");
    }

    public function showEdit($id)
    {
        return view('edit-product', ["product" => $this->productService->getDetailProduct($id)]);
    }
    
    public function showAddProduct()
    {
        return view('add-product');
    }

    public function edit(ProductRequest $request, $id)
    {
        $this->productService->updateProduct($request->validated(), $id);
        return redirect()->route('home')->with("success", "Data was successfully updated");
    }

    public function delete($id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('home')->with("success", "Data was successfully deleted");
    }
}
