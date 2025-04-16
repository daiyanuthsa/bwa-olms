<?php
namespace App\Services;

use App\Models\Pricing;
use App\Models\Transaction;
use App\Repositories\PricingRepository;
use App\Repositories\TransactionRepository;
use Auth;

class TransactionService
{
    protected $transactionRepository;
    protected $pricingRepository;
    public function __construct(
        TransactionRepository $transactionRepository,
        PricingRepository $pricingRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->pricingRepository = $pricingRepository;
    }
    public function prepareCheckout(Pricing $pricing)
    {
        $user = Auth::user();
        $alreadySubscribed = $pricing->isSubscribed($user->id);

        $tax = 0.12;
        $total_tax_amount = $pricing->price * $tax;
        $total_sub_amount = $pricing->price;
        $total_grand_amount = $total_sub_amount + $total_tax_amount;

        $started_at = now();
        $ended_at = now()->addDays($pricing->duration);

        session()->put("pricing_id", $pricing->id);

        return compact(
            'pricing',
            'user',
            'alreadySubscribed',
            'total_sub_amount',
            'total_tax_amount',
            'total_grand_amount',
            'started_at',
            'ended_at');
    }

    public function getRecentPricing(){
        $pricingId = session()->get("pricing_id");
        if ($pricingId) {
            $pricing = $this->pricingRepository->getPackageById($pricingId);
            if ($pricing) {
                return $pricing;
            }
        }
        return null;
    }

    public function getUserTransaction(){
        $user = Auth::user();
        
        return $this->transactionRepository->getUserTransactions($user->id);
        // Alternatively, you can use the Transaction model directly
        // Uncomment the following lines if you want to use the Transaction model directly
        // return Transaction::with('pricing')
        //     ->where('user_id', $user->id)
        //     ->orderBy('created_at', 'desc')
        //     ->get();
    }
}
?>