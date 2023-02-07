<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\BrandService;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $productService;
    private $brandService;

    public function __construct(ProductService $productService, BrandService $brandService)
    {
        $this->productService = $productService;
        $this->brandService = $brandService;
    }

    public function showHome()
    {
        return view('home', ["products" => $this->productService->getAllProduct()]);
    }

    public function showAddProduct()
    {
        return view('add-product', ["brands" => $this->brandService->getAllBrand()]);
    }

    public function showEditProduct($id)
    {
        return view('edit-product', [
            "product" => $this->productService->getDetailProduct($id),
            "brands" => $this->brandService->getAllBrand()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $this->productService->saveProduct($request->validated());
        return redirect()->route('home')->with("success", "Data was successfully added");
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
