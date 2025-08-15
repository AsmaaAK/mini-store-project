<?php
namespace MiniStore\Modules\Payments;

interface PaymentGateway
{
    public function processPayment(float $amount);
    public function getPaymentDetails();
}