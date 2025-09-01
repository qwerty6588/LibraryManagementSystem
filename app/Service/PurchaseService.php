<?php

namespace App\Service;

use App\Models\Purchase;
use App\Repository\PurchaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class PurchaseService
{
    protected PurchaseRepository $purchaseRepository;

    public function __construct(PurchaseRepository $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    /**
     * @throws Exception
     */
    public function getPurchases(): Collection
    {
        $purchases = $this->purchaseRepository->getPurchases();
        if ($purchases->isEmpty()) {
            throw new Exception('Purchases not found');
        }
        return $purchases;
    }

    /**
     * @throws Exception
     */
    public function createPurchase(array $data): Purchase
    {
        $result = $this->purchaseRepository->create(
            $data['user_id'],
            $data['book_id'],
            $data['quantity'],
            $data['purchased_at']
        );

        if (!$result) {
            throw new Exception('Purchase not created');
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function updatePurchase(int $id, array $data): Purchase
    {
        $purchase = $this->findPurchaseById($id);

        $updated = $this->purchaseRepository->update(
            $purchase,
            $data['user_id'],
            $data['book_id'],
            $data['quantity'],
            $data['purchased_at']
        );

        if (!$updated) {
            throw new Exception('Purchase not updated');
        }

        return $this->findPurchaseById($id);
    }

    /**
     * @throws Exception
     */
    public function deletePurchase(int $id): bool
    {
        $purchase = $this->findPurchaseById($id);
        return $this->purchaseRepository->delete($purchase);
    }

    /**
     * @throws Exception
     */
    public function findPurchaseById(int $id): Purchase
    {
        $purchase = $this->purchaseRepository->findById($id);
        if (!$purchase) {
            throw new Exception('Purchase not found');
        }

        return $purchase;
    }
}
