<?php

namespace MiniStore\Traits;

trait OrderStatusTrait
{
    protected $status = 'pending';

    public function setStatus(string $status): void
    {
        $this->status = $status;
        $this->logAction("Order status changed to: $status");
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}