<?php
namespace MiniStore\Modules\Orders;

use MiniStore\Modules\Users\Customer;
use MiniStore\Modules\Products\Product;
use MiniStore\Traits\LoggingTrait;
use MiniStore\Traits\DiscountTrait;
use MiniStore\Traits\OrderStatusTrait;

class Order
{
    use LoggingTrait, DiscountTrait, OrderStatusTrait;

    private string $orderId;
    private Customer $customer;
    private array $products = [];
    private float $totalAmount = 0;
    private \DateTime $orderDate;

    public function __construct(Customer $customer)
    {
        $this->orderId = uniqid('ORDER_');
        $this->customer = $customer;
        $this->orderDate = new \DateTime();
        $this->logAction("New order created: {$this->orderId}");
    }

    public function addProduct(Product $product, int $quantity = 1): void
    {
        if ($quantity <= 0) {
            throw new \InvalidArgumentException("Quantity must be greater than zero");
        }

        $product->decreaseStock($quantity);
        
        $this->products[] = [
            'product' => $product,
            'quantity' => $quantity,
            'subtotal' => $product->getPrice() * $quantity
        ];

        $this->totalAmount += $product->getPrice() * $quantity;
        $this->logAction("Added product {$product->getName()} (x$quantity) to order {$this->orderId}");
    }

    public function calculateTotal(): float
    {
        $total = $this->totalAmount;
        
        // Apply discount if order is large
        if ($total > 100) {
            $total = $this->applyDiscount($total);
        }
        
        // Add tax
        $total *= (1 + TAX_RATE);
        
        return round($total, 2);
    }

    public function getOrderDetails(): array
    {
        return [
            'order_id' => $this->orderId,
            'customer' => $this->customer->getName(),
            'order_date' => $this->orderDate->format('Y-m-d H:i:s'),
            'products' => array_map(function($item) {
                return [
                    'name' => $item['product']->getName(),
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['product']->getPrice(),
                    'subtotal' => $item['subtotal']
                ];
            }, $this->products),
            'total_amount' => $this->calculateTotal(),
            'status' => $this->getStatus()
        ];
    }
}
