<?php

namespace App\Services;

use App\Helper\ImageHelper;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Support\Arr;

class BrandService
{
    public $brandRepo;
    public $imageHelper;

    public function __construct(BrandRepositoryInterface $brandRepo, ImageHelper $imageHelper)
    {
        $this->brandRepo = $brandRepo;
        $this->imageHelper = $imageHelper;
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
        if (Arr::exists($request, 'image')) {
            $image = $this->imageHelper->saveImage($request['image']);
            $request['image'] = $image;
        }
        return $this->brandRepo->createBrand($request);
    }

    public function updateBrand($request, $id)
    {
        $brandDetail = $this->brandRepo->getBrandById($id);
        if (Arr::exists($request, 'image')) {
            $image = $this->imageHelper->saveImage($request['image']);
            if ($brandDetail->image != null) {
                $this->imageHelper->deleteImage($brandDetail->image);
            }
            $request['image'] = $image;
        }
        return $this->brandRepo->updateBrand($request, $id);
    }

    public function deleteBrand($id)
    {
        $brandDetail = $this->brandRepo->getBrandById($id);
        if ($brandDetail->image != null) {
            if ($this->imageHelper->deleteImage($brandDetail->image)) {
                $this->brandRepo->deleteBrand($id);
            }
        }
        return $this->brandRepo->deleteBrand($id);
    }
}
