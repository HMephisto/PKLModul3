<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\BrandResource;
use App\Services\BrandService;

class BrandController extends Controller
{
    private $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function getAllBrand()
    {
        return new BrandCollection($this->brandService->getAllBrand());
    }

    public function getBrandDetail($id)
    {
        return $this->brandResponse($this->brandService->getDetailBrand($id));
    }

    public function store(BrandRequest $request)
    {
        $product = $this->brandService->saveBrand($request->validated());
        return $this->brandResponse($product);
    }

    public function edit(BrandRequest $request, $id)
    {
        $product = $this->brandService->updateBrand($request->validated(), $id);
        return $this->brandResponse($product);
    }

    public function delete($id)
    {
        $product = $this->brandService->deleteBrand($id);
        return $this->brandResponse($product);
    }

    public function brandResponse($brand)
    {
        return new BrandResource($brand);
    }
}
