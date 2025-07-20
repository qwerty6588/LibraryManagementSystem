<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Category::class;
    }

    public function getCategories(): Collection
    {
        return $this->model->all();
    }

    public function create(string $name): ?Category
    {
        return $this->model->create([
            'name' => $name,
        ]);
    }

    public function update(Category $category, string $name): bool
    {
        return $category->update([
            'name' => $name,
        ]);
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    public function findById(int $id): ?Category
    {
        return $this->model::find($id) ?: null;
    }
}
