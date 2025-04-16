<?php
namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Support\Collection;
class TransactionRepository implements TransactionRepositoryInterface
{
    public function findByBookingId(String $bookingId): ?Transaction
    {
        return Transaction::where('booking_trx_id', $bookingId)->first();
    }
    public function createTransaction(array $data): Transaction
    {
        return Transaction::create($data);
    }
    public function getUserTransactions(int $userId): Collection
    {
        return Transaction::with('pricing')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
?>