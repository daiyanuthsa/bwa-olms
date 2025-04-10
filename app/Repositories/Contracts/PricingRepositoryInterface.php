<?php 
namespace App\Repositories\Contracts;

use App\Models\Pricing;
use Illuminate\Support\Collection;
interface PricingRepositoryInterface
{
    public function getAllPackages(): Collection;
    public function getPackageById(int $id): ?Pricing;
    
}
?>