<?php

namespace App\Service;

use App\Models\Author;
use App\Repository\AuthorRepository;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class AuthorService
{
    protected $authorRepository;

    public function __construct()
    {
        $this->authorRepository = new AuthorRepository();
    }

    public function getAuthors(): Collection
    {
        $authors = $this->authorRepository->getAuthors();
        if (empty($authors) || $authors->count() === 0) {
            throw new Exception('Authors not found');
        }
        return $authors;
    }

    public function createAuthor(array $data): Author
    {
        $result = $this->authorRepository->create(
            $data['name'],
        );
        if (!$result) {
            throw new Exception('Author not created');
        }

        return $result;
    }

    public function updateAuthor(int $id, array $data): Author
    {
        $author = $this->findAuthorById($id);
        $updated = $this->authorRepository->update(
            $author,
            $data['name'],
        );
        if (!$updated) {
            throw new Exception('Author not updated');
        }
        return $this->findAuthorById($id);
    }

    public function deleteAuthor(int $id): bool
    {
        $author = $this->findAuthorById($id);
        return $this->authorRepository->delete($author);
    }

    public function findAuthorById(int $id): Author
    {
        $author = $this->authorRepository->findById($id);
        if (!$author) {
            throw new Exception('Author not found');
        }
        return $author;
    }
}

