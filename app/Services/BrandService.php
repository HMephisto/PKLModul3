<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepositoryInterface;

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
        $this->brandRepo->createBrand($request);
    }

    public function updateBrand($request, $id)
    {
        $this->brandRepo->updateBrand($request, $id);
    }

    public function deleteBrand($id)
    {
        $this->brandRepo->deleteBrand($id);
    }
}
