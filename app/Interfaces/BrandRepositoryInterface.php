<?php

namespace App\Interfaces;

interface BrandRepositoryInterface
{
    public function getAllBrand();
    public function getBrandById($id);
    public function createBrand(array $BrandDetails);
    public function updateBrand(array $newDetails, $id);
    public function deleteBrand($id);
}