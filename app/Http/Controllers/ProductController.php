<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::orderBy("id", "ASC")->get();
        return view('beranda', ["products" => $products]);
    }
    public function store(ProductRequest $r)
    {
        Product::create([
            "name" => $r->name,
            "price" => $r->price,
            "brand" => $r->brand,
        ]);

        return redirect()->route('home')->with("success", "Data berhasil ditambahkan");
    }

    public function show_edit($id)
    {
        $product = Product::findorfail($id);

        return view('edit_product', ["product" => $product]);
    }

    public function edit(ProductRequest $r, $id)
    {

        $product = Product::findorfail($id);
        $product->name = $r->name;
        $product->price = $r->price;
        $product->brand = $r->brand;
        $product->save();

        return redirect()->route('home')->with("success", "Data berhasil diupdate");
    }

    public function delete($id)
    {
        $product = Product::findorfail($id);
        $product->delete();
        return redirect()->route('home')->with("success", "Data berhasil dihapus");
    }
}
