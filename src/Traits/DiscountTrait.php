<?php
namespace MiniStore\Traits;

trait DiscountTrait
{
    public function applyDiscount($amount)
    {
        $this->logAction("Applying discount of " . (DISCOUNT_PERCENTAGE * 100) . "%");
        return $amount * (1 - DISCOUNT_PERCENTAGE);
    }
}