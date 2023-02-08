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

    public function createBrand($BrandDetails, $imageName)
    {
        $this->brands::create([
            "name" => $BrandDetails["name"],
            "image" => $imageName,
        ]);
    }

    public function updateBrand($newDetails, $id, $imageName)
    {
        $this->brands::findorfail($id)->update([
            "name" => $newDetails["name"],
            "image" => $imageName,
        ]);
    }

    public function deleteBrand($id)
    {
        return $this->brands::findorfail($id)->delete();
    }
}
