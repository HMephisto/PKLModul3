<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function showHome()
    {
        return view('home', ["products" => $this->productRepository->getAllProduct()]);
    }

    public function showAddProduct()
    {
        return view('add-product');
    }

    public function showEditProduct($id)
    {
        return view('edit-product', ["product" => $this->productRepository->getProductById($id)]);
    }

    public function store(ProductRequest $request)
    {
        $this->productRepository->createProduct($request->validated());
        return redirect()->route('home')->with("success", "Data was successfully added");
    }

    public function edit(ProductRequest $request, $id)
    {
        $this->productRepository->updateProduct($request->validated(), $id);
        return redirect()->route('home')->with("success", "Data was successfully updated");
    }

    public function delete($id)
    {
        $this->productRepository->deleteProduct($id);
        return redirect()->route('home')->with("success", "Data was successfully deleted");
    }
}
