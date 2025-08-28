<?php

namespace App\Service;

use App\Models\Category;
use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class CategoryService
{
    protected $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }


    public function getCategories(): Collection
    {
        $categories = $this->categoryRepository->getCategories();
        if (empty($categories) || $categories->count() === 0) {
            throw new Exception('Categories not found');
        }
        return $categories;
    }


    public function createCategory(array $data): Category
    {
        $result = $this->categoryRepository->create(
            $data['name'],
        );

        if (!$result) {
            throw new Exception('Category not created');
        }
        return $result;
    }

    public function updateCategory(int $id, array $data): Category
    {
        $category = $this->findCategoryById($id);
        $updated = $this->categoryRepository->update(
            $category,
            $data['name']
        );
        if (!$updated) {
            throw new Exception('Another category with this name already exists');
        }
        return $this->findCategoryById($id);
   }

    public function deleteCategory(int $id): bool
    {
        $category = $this->findCategoryById($id);
        return $this->categoryRepository->delete($category);

    }

    public function findCategoryById(int $id): Category
    {
        $category = $this->categoryRepository->findByName($id);
        if (!$category) {
            throw new Exception('Category not found');
        }
        return $category;
    }
}
