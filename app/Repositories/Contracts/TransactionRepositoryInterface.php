<?php
namespace App\Repositories\Contracts;

use App\Models\Transaction;
use Illuminate\Support\Collection;
interface TransactionRepositoryInterface
{
    public function findByBookingId(String $bookingId): ?Transaction;
    public function createTransaction(array $data): Transaction;
    public function getUserTransactions(int $userId): Collection;
}
?>