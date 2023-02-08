<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Support\Arr;

class BrandService
{
    public $brandRepo;
    public $imageService;

    public function __construct(BrandRepositoryInterface $brandRepo, ImageService $imageService)
    {
        $this->brandRepo = $brandRepo;
        $this->imageService = $imageService;
    }

    public function getAllBrand()
    {
        return $this->brandRepo->getAllBrand();
    }

    public function getDetailBrand($id)
    {
        return $this->brandRepo->getBrandById($id);
    }

    public function saveBrand($request)
    {
        $image = null;
        if (Arr::exists($request, 'image')) {
            $image = $this->imageService->saveImage($request['image']);
        }
        $this->brandRepo->createBrand($request, $image);
    }

    public function updateBrand($request, $id)
    {
        $brandDetail = $this->brandRepo->getBrandById($id);
        $image = $brandDetail->image;
        if (Arr::exists($request, 'image')) {
            $image = $this->imageService->saveImage($request['image']);
            if ($brandDetail->image != null) {
                $this->imageService->deleteImage($brandDetail->image);
            }
        }
        $this->brandRepo->updateBrand($request, $id, $image);
    }

    public function deleteBrand($id)
    {
        $brandDetail = $this->brandRepo->getBrandById($id);
        if ($this->imageService->deleteImage($brandDetail->image)) {
            $this->brandRepo->deleteBrand($id);
        }
    }
}
