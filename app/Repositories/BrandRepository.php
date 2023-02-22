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
        return $this->brands::with("product")->paginate();
    }

    public function getBrandById($id)
    {
        return $this->brands::with("product")->findorfail($id);
    }

    public function searchProduct($name)
    {
        return $this->brands::where("name", "ilike", "%".$name."%")->paginate();
    }

    public function createBrand($BrandDetails)
    {
        return $this->brands::create($BrandDetails);
        // $this->brands::create([
        //     "name" => $BrandDetails["name"],
        //     "image" => $imageName,
        // ]);
    }

    public function updateBrand($newDetails, $id)
    {
        return tap($this->brands::findorfail($id))->update($newDetails);
    }

    public function deleteBrand($id)
    {
        return tap($this->brands::findorfail($id))->delete();
    }
}
