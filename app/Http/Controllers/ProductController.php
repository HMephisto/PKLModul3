<?php

namespace App\Http\Controllers;

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
    public function store(Request $r)
    {
        $r->validate([
            "name" => "required|string",
            "price" => "required|integer",
            "brand" => "required|string",
        ]);

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

    public function edit(Request $r, $id)
    {
        $r->validate([
            "name" => "required|string",
            "price" => "required|integer",
            "brand" => "required|string",
        ]);

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
