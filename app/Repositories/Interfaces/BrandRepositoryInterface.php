<?php

namespace App\Repositories\Interfaces;

interface BrandRepositoryInterface
{
    public function getAllBrand();
    public function getBrandById($id);
    public function createBrand(array $BrandDetails, $image);
    public function updateBrand(array $newDetails, $id, $image);
    public function deleteBrand($id);
}