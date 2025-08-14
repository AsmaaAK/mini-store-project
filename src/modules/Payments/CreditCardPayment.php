<?php
namespace MiniStore\Modules\Payments;

class CreditCardPayment implements PaymentGateway
{
    use \MiniStore\Traits\LoggingTrait;

    private string $cardNumber;
    private string $cardHolder;
    private string $expiryDate;
    private string $cvv;
    private string $transactionId;
    private bool $paymentStatus = false;

    public function __construct(string $cardNumber, string $cardHolder, string $expiryDate, string $cvv)
    {
        $this->cardNumber = $cardNumber;
        $this->cardHolder = $cardHolder;
        $this->expiryDate = $expiryDate;
        $this->cvv = $cvv;
    }

    public function processPayment(float $amount)
    {
        $this->transactionId = uniqid('CC_');
        $this->paymentStatus = true; 
        
        $this->logAction(
            "Credit card payment processed. Amount: $amount, " .
            "Transaction ID: $this->transactionId, " .
            "Last 4 digits: " . substr($this->cardNumber, -4)
        );
        
        return $this->paymentStatus;
    }

    public function getPaymentDetails()
    {
        return [
            'method' => 'Credit Card',
            'card_holder' => $this->cardHolder,
            'last_4_digits' => substr($this->cardNumber, -4),
            'transaction_id' => $this->transactionId,
            'status' => $this->paymentStatus ? 'completed' : 'failed'
        ];
    }
}