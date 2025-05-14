<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Services\PaymentService;
use App\Services\PricingService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class FrontController extends Controller
{
    protected $transactionService;
    protected $paymentService;
    protected $pricingService;

    public function __construct(
        PaymentService $paymentService,
        TransactionService $transactionService,
        PricingService $pricingService
    ) {
        $this->paymentService = $paymentService;
        $this->transactionService = $transactionService;
        $this->pricingService = $pricingService;
    }

    public function index()
    {
        return view('front.index');
    }
    public function pricing()
    {
        $pricing = $this->pricingService->getAllPackages();
        $user = Auth::user();
        return view('front.pricing', compact('pricing','user'));
    }

    public function checkout(Pricing $pricing)
    {
        $checkoutData = $this->transactionService->prepareCheckout($pricing);

        if ($checkoutData['alreadySubscribed'] ) {
            return redirect()->route('front.pricing')->with('error', 'You already subscribed to this package');
        }
        return view('front.checkout',  $checkoutData);
    }

    public function paymentStoreMidtrans()
    {
        try {
            $pricingId = session()->get('pricing_id');
            Log::Info('Pricing ID from session: ' . $pricingId);
            if (!$pricingId) {
                return response()->json(['error' => 'Pricing ID not found in session'], 400);
            }
            $snapToken = $this->paymentService->createPayment($pricingId);
            Log::Info('Snap Token: ' . $snapToken);
            if (!$snapToken) {
                return response()->json(['error' => 'Failed to create payment token'], 500);
            }
            return response()->json(['snap_token' => $snapToken], 200);
            

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create payment token'], 500);
        }
    }

    public function paymentMidtransNotification(Request $request){
        try {
            $transactionStatus = $this->paymentService->handlePaymentNotification();
            if (!$transactionStatus) {
                // Handle successful payment
                return response()->json(['error' => 'iInvalid Notification Data'], 400);
            } 
            return response()->json(['status' => $transactionStatus], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to handle notification'], 500);
        }
    }


    public function checkout_success()
    {
        $pricing = $this->transactionService->getRecentPricing();
        if (!$pricing) {
            return redirect()->route('front.index')->with('error', 'No recent transaction found');
        }
        return view('front.checkout_success', compact('pricing'));
    }

}
