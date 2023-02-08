<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class BrandService
{
    public $brandRepo;

    public function __construct(BrandRepositoryInterface $brandRepo)
    {
        $this->brandRepo = $brandRepo;
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
        $image = $this->saveImage($request['image']);
        $this->brandRepo->createBrand($request, $image);
    }

    public function updateBrand($request, $id)
    {
        $brandDetail = $this->brandRepo->getBrandById($id);
        $image = $brandDetail->image;
        if (Arr::exists($request, 'image')) {
            $image = $this->saveImage($request['image']);
            $this->deleteImage($brandDetail->image);
        }
        $this->brandRepo->updateBrand($request, $id, $image);
    }

    public function deleteBrand($id)
    {
        $brandDetail = $this->brandRepo->getBrandById($id);
        if ($this->deleteImage($brandDetail->image)) {
            $this->brandRepo->deleteBrand($id);
        }
    }

    public function saveImage($file)
    {
        return Storage::putFile('images', $file);
    }

    public function editImage($oldFile, $newFile)
    {
        if ($this->deleteImage($oldFile)) {
            return $this->saveImage($newFile);
        }
        return false;
    }

    public function deleteImage($filename)
    {
        return Storage::delete($filename);
    }
}
