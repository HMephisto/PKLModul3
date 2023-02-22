<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategory();
    public function getCategoryById($id);
    public function searchProduct($name);
    public function createCategory(array $CategoryDetails);
    public function updateCategory(array $newDetails, $id);
    public function deleteCategory($id);
}