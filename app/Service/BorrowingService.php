<?php

namespace App\Service;

use App\Models\Borrowing;
use App\Repository\BorrowingRepository;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class BorrowingService
{
    protected BorrowingRepository $borrowingRepository;

    public function __construct(BorrowingRepository $borrowingRepository)
    {
        $this->borrowingRepository = $borrowingRepository;
    }

    /**
     * @throws Exception
     */
    public function getBorrowings(): Collection
    {
        $borrowings = $this->borrowingRepository->getBorrowings();
        if (empty($borrowings) || $borrowings->count() === 0)  {
            throw new Exception('Borrowings not found');
        }
        return $borrowings;
    }

    /**
     * @throws Exception
     */
    public function createBorrowing(array $data): Borrowing
    {
        $result = $this->borrowingRepository->create(
            $data['user_id'],
            $data['book_id'],
            $data['borrowed_at'],
            $data['due_date'],
            $data['returned_at']
        );

        if (!$result) {
            throw new Exception('Borrowing not created');
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function updateBorrowing(int $id, array $data): Borrowing
    {
        $borrowing = $this->findBorrowingById($id);
        $updated = $this->borrowingRepository->update(
            $borrowing,
            $data['user_id'],
            $data['book_id'],
            $data['borrowed_at'],
            $data['due_date'],
            $data['returned_at']
        );
        if (!$updated) {
            throw new Exception('Borrowing not updated');
        }
        return $this->findBorrowingById($id);
    }

    /**
     * @throws Exception
     */
    public function deleteBorrowing(int $id): bool
    {
        $borrowing = $this->deleteBorrowing($id);
        return $this->borrowingRepository->delete($borrowing);
    }

    /**
     * @throws Exception
     */
    public function findBorrowingById(int $id): Borrowing
    {
        $borrowing = $this->borrowingRepository->findById($id);
        if (!$borrowing) {
            throw new Exception('Borrowing not found');
        }

        return $borrowing;
    }
}
