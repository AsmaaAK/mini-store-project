<?php
namespace MiniStore\Traits;

trait OrderStatusTrait
{
    protected $status = 'pending';

    public function setStatus(string $status)
    {
        $this->status = $status;
        $this->logAction("Order status changed to: $status");
    }

    public function getStatus()
    {
        return $this->status;
    }
}