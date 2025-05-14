<?php
namespace App\Repositories;

use App\Models\Pricing;
use App\Repositories\Contracts\PricingRepositoryInterface;
use Illuminate\Support\Collection;

class PricingRepository implements PricingRepositoryInterface
{

    public function getAllPackages(): Collection
    {
        return Pricing::all();
    }

    public function getPackageById(int $id): ? Pricing
    {
        return Pricing::where('id', $id)->first();
    }
    
}

?>