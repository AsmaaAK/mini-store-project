<?php
require_once __DIR__ . '/autoload.php';
$config = require __DIR__ . '/config.php';

use MiniStore\Modules\Products\Product;
use MiniStore\Modules\Users\Customer;
use MiniStore\Modules\Orders\Order;
use MiniStore\Modules\Payments\CreditCardPayment;

// إنشاء بيانات العرض
$product1 = new Product('P001', 'Laptop', 999.99, 10, 'High performance laptop');
$product2 = new Product('P002', 'Smartphone', 499.99, 20, 'Latest model');
$product3 = new Product('P003', 'Headphones', 99.99, 30, 'Noise cancelling');

$customer = new Customer(
    'C001',
    'Asmaa',
    'asmaa@example.com',
    'securepassword',
    '123 Main St, City',
    '555-1234'
);

$order = new Order($customer);
$order->addProduct($product1, 1);
$order->addProduct($product2, 2);
$order->addProduct($product3, 1);

$payment = new CreditCardPayment(
    '4111111111111111',
    'Asmaa',
    '12/25',
    '123'
);

$paymentResult = $payment->processPayment($order->calculateTotal());
$order->setStatus($paymentResult ? 'paid' : 'payment_failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniStore Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .receipt { border: 1px solid #ddd; padding: 20px; max-width: 600px; margin: 0 auto; }
        .success { color: green; }
        .failed { color: red; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>MiniStore Receipt</h1>
        
        <div class="<?= $paymentResult ? 'success' : 'failed' ?>">
            <?= $paymentResult ? '✅ Payment Successful' : '❌ Payment Failed' ?>
        </div>
        
        <h2>Order Details</h2>
        <p><strong>Order ID:</strong> <?= $order->getOrderDetails()['order_id'] ?></p>
        <p><strong>Customer:</strong> <?= $order->getOrderDetails()['customer'] ?></p>
        <p><strong>Status:</strong> <?= $order->getOrderDetails()['status'] ?></p>
        
        <h3>Products</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($order->getOrderDetails()['products'] as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td>$<?= number_format($product['unit_price'], 2) ?></td>
                <td><?= $product['quantity'] ?></td>
                <td>$<?= number_format($product['subtotal'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>$<?= number_format($order->calculateTotal(), 2) ?></strong></td>
            </tr>
        </table>
        
        <h2>Payment Details</h2>
        <p><strong>Method:</strong> <?= $payment->getPaymentDetails()['method'] ?></p>
        <p><strong>Card Ending:</strong> **** **** **** <?= $payment->getPaymentDetails()['last_4_digits'] ?? '1111' ?></p>
        <p><strong>Status:</strong> <?= $payment->getPaymentDetails()['status'] ?></p>
    </div>
</body>
</html>