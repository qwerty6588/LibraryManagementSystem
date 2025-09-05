<?php

namespace App\Repository;

use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;

class AuthorRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Author::class;
    }

    public function getAuthors(): Collection
    {
        return $this->model->all();
    }

    public function findByName(int $id)
    {
        return $this->model::find($id) ?: null;
    }

    public function create(string $name): ?Author
    {
      return $this->model->create([
          'name' => $name,
      ]);
    }

    public function update(Author $author, string $name): bool
    {
        return $author->update([
            'name' => $name,
        ]);
    }

    public function delete(Author $author): bool
    {
        return $author->delete();
    }


    public function firstOrCreate(array $data): Author
    {
        return $this->model->firstOrCreate($data);
    }
}
