<?php
require_once __DIR__ . '/../src/Modules/Users/User.php'; // الأساسي أولاً
require_once __DIR__ . '/../src/Modules/Users/Customer.php';
require_once __DIR__ . '/../src/Modules/Products/Product.php';

use MiniStore\Modules\Users\User;
use MiniStore\Modules\Users\Customer;
use MiniStore\Modules\Products\Product;
// جلب المنتجات من PHP
$products = [
    new Product('P001', 'Laptop', 999.99, 10),
    new Product('P002', 'Smartphone', 499.99, 20),
    new Product('P003', 'Headphones', 99.99, 30)
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>MiniStore</title>
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 20px;
    background-color: #f5f5f5;
    color: #333;
}

/* تنسيقات المنتجات */
.product {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.product:hover {
    transform: translateY(-5px);
}

.product h3 {
    color: #2c3e50;
    margin-top: 0;
}

/* تنسيقات عربة التسوق */
.cart {
    background: #fff;
    border: 2px solid #3498db;
    border-radius: 8px;
    padding: 20px;
    margin-top: 30px;
}

#cart-items {
    margin: 15px 0;
}

/* الأزرار */
button {
    background: #3498db;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background: #2980b9;
}

/* التكيف مع الشاشات الصغيرة */
@media (max-width: 768px) {
    body {
        padding: 10px;
    }
    
    .product, .cart {
        padding: 10px;
    }
}
    </style>
</head>
<body>
    <h1>MiniStore Products</h1>
    
    <div id="products">
    <?php foreach ($products as $product): ?>
    <div class="product">
        <h3><?= htmlspecialchars($product->getName()) ?></h3>
        <p>Price: $<?= number_format($product->getPrice(), 2) ?></p>
        <button onclick="addToCart('<?= $product->getId() ?>')">Add to Cart</button>
    </div>
    <?php endforeach; ?>
   </div>
    
    <div class="cart">
        <h2>Your Cart</h2>
        <div id="cart-items"></div>
        <div id="cart-total"></div>
        <button id="checkout-btn">Checkout</button>
    </div>

    <script src="js/app.js"></script>
</body>
</html>