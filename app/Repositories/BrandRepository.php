<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
    private $brands;

    public function __construct()
    {
        $this->brands = new Brand();
    }
    public function getAllBrand()
    {
        return $this->brands::oldest("id")->get();
    }

    public function getBrandById($id)
    {
        return $this->brands::findorfail($id);
    }

    public function createBrand($BrandDetails)
    {
        $this->brands::create($BrandDetails);
    }

    public function updateBrand($newDetails, $id)
    {
        $this->brands::where('id', $id)->update($newDetails);
    }

    public function deleteBrand($id)
    {
        $this->brands::where('id', $id)->delete();
    }
}
