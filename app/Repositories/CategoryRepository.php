<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    private $categories;

    public function __construct()
    {
        $this->categories = new Category();
    }
    public function getAllCategory()
    {
        return $this->categories::with('child')->paginate();
    }

    public function getCategoryById($id)
    {
        return $this->categories::with('child')->findorfail($id);
    }

    public function searchProduct($name)
    {
        return $this->categories::where("name", "ilike", "%".$name."%")->paginate();
    }

    public function createCategory($CategoryDetails)
    {
        return $this->categories::create($CategoryDetails);
    }

    public function updateCategory($newDetails, $id)
    {
        return tap($this->categories::findorfail($id))->update($newDetails);
    }

    public function deleteCategory($id)
    {
        return tap($this->categories::findorfail($id))->delete();
    }
}
