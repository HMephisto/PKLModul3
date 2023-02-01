<?php

namespace App\Services;

use App\Models\Brand;

class BrandService
{
    public $brands;
    
    public function __construct()
    {
        $this->brands = new Brand();
    }

    public function getAllBrand()
    {
        return $this->brands::orderBy("id", "ASC")->get();
    }

    public function getDetailBrand($id)
    {
        return $this->brands::findorfail($id);
    }

    public function saveBrand($request)
    {
        $this->brands::create($request);
    }

    public function updateBrand($request, $id)
    {
        $this->brands::where("id", $id)->update($request);
    }

    public function deleteBrand($id)
    {
        $this->brands::where("id", $id)->delete();
    }
}