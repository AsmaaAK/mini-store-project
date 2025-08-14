<?php
require __DIR__ . '/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/src/Modules/Products/products.php';
require_once __DIR__ . '/src/Modules/Users/User.php';
require_once __DIR__ . '/src/Modules/Users/Customer.php';
require_once __DIR__ . '/src/Modules/Users/Admin.php';
require_once __DIR__ . '/src/Modules/Orders/Order.php';
require_once __DIR__ . '/src/Modules/Payments/PaymentGateway.php';
require_once __DIR__ . '/src/Modules/Payments/PayPalPayment.php';
require_once __DIR__ . '/src/Modules/Payments/CreditCardPayment.php';
require_once __DIR__ . '/src/Traits/LoggingTrait.php';
require_once __DIR__ . '/src/Traits/DiscountTrait.php';
require_once __DIR__ . '/src/Traits/OrderStatusTrait.php';

// إنشاء منتجات
$product1 = new \MiniStore\Modules\Products\Product('P001', 'Laptop', 999.99, 10, 'High performance laptop');
$product2 = new \MiniStore\Modules\Products\Product('P002', 'Smartphone', 499.99, 20, 'smartphone model');
$product3 = new \MiniStore\Modules\Products\Product('P003', 'Headphones', 99.99, 30, 'headphones');

// إنشاء عميل
$customer = new \MiniStore\Modules\Users\Customer(
    'C001', 
    'Asmaa', 
    'Ak@example.com', 
    'password97', 
    '123 Taiz, City', 
    '555-1234'
);

// إنشاء طلب
$order = new \MiniStore\Modules\Orders\Order($customer);
$order->addProduct($product1, 1);
$order->addProduct($product2, 2);
$order->addProduct($product3, 1);

// معالجة الدفع
$paymentMethod = new \MiniStore\Modules\Payments\CreditCardPayment(
    '4111111111111111',
    'Asmaa',
    '12/25',
    '123'
);

if ($paymentMethod->processPayment($order->calculateTotal())) {
    $order->setStatus('paid');
    echo "Payment successful! Order ID: " . $order->getOrderDetails()['order_id'] . "\n";
} else {
    $order->setStatus('payment_failed');
    echo "Payment failed. Please try again.\n";
}

// عرض تفاصيل الطلب
echo "<pre>";
print_r($order->getOrderDetails());
print_r($paymentMethod->getPaymentDetails());
echo "</pre>";