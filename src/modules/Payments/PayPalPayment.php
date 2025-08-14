<?php
namespace MiniStore\Modules\Payments;

class PayPalPayment implements PaymentGateway
{
    use \MiniStore\Traits\LoggingTrait;

    private string $email;
    private string $transactionId;
    private bool $paymentStatus = false;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function processPayment(float $amount)
    {
        $this->transactionId = uniqid('PAYPAL_');
        $this->paymentStatus = (rand(0, 1) === 1); // 50% success rate for simulation
        
        $this->logAction(
            $this->paymentStatus 
                ? "PayPal payment successful. Amount: $amount, Transaction ID: $this->transactionId"
                : "PayPal payment failed. Amount: $amount"
        );
        
        return $this->paymentStatus;
    }

    public function getPaymentDetails()
    {
        return [
            'method' => 'PayPal',
            'email' => $this->email,
            'transaction_id' => $this->transactionId,
            'status' => $this->paymentStatus ? 'completed' : 'failed'
        ];
    }
}