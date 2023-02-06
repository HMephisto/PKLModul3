<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Interfaces\BrandRepositoryInterface;

class BrandController extends Controller
{
    private BrandRepositoryInterface $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function showBrands()
    {
        return view('brand', ["brands" => $this->brandRepository->getAllBrand()]);
    }

    public function showAddBrand()
    {
        return view('add-brand');
    }

    public function showEditBrand($id)
    {
        return view('edit-brand', ["brand" => $this->brandRepository->getBrandById($id)]);
    }

    public function store(BrandRequest $request)
    {
        $this->brandRepository->createBrand($request->validated());
        return redirect()->route('brand')->with("success", "Data was successfully added");
    }

    public function edit(BrandRequest $request, $id)
    {
        $this->brandRepository->updateBrand($request->validated(), $id);
        return redirect()->route('brand')->with("success", "Data was successfully updated");
    }

    public function delete($id)
    {
        $this->brandRepository->deleteBrand($id);
        return redirect()->route('brand')->with("success", "Data was successfully deleted");
    }

    public function showBrandwithProduct()
    {
        $brands = $this->brandRepository->getAllBrandWithProduct();
        return response()->json($brands);
    }

}
