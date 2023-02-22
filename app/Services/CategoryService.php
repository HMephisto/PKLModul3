<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    public $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo,)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllCategory()
    {
        return $this->categoryRepo->getAllCategory();
    }

    public function getDetailCategory($id)
    {
        return $this->categoryRepo->getCategoryById($id);
    }

    public function saveCategory($request)
    {
        return $this->categoryRepo->createCategory($request);
    }

    public function updateCategory($request, $id)
    {
        return $this->categoryRepo->updateCategory($request, $id);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepo->deleteCategory($id);
    }

}
