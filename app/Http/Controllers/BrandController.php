<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Services\BrandService;

class BrandController extends Controller
{
    private $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function showBrands()
    {
        return view('brand', ["brands" => $this->brandService->getAllBrand()]);
    }

    public function showAddBrand()
    {
        return view('add-brand');
    }

    public function showEditBrand($id)
    {
        return view('edit-brand', ["brand" => $this->brandService->getDetailBrand($id)]);
    }

    public function store(BrandRequest $request)
    {
        $this->brandService->saveBrand($request->validated());
        return redirect()->route('brand')->with("success", "Data was successfully added");
    }

    public function edit(BrandRequest $request, $id)
    {
        $this->brandService->updateBrand($request->validated(), $id);
        return redirect()->route('brand')->with("success", "Data was successfully updated");
    }

    public function delete($id)
    {
        $this->brandService->deleteBrand($id);
        return redirect()->route('brand')->with("success", "Data was successfully deleted");
    }
}
