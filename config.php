<?php
define('TAX_RATE', 0.15); // ضريبة 15%
define('DISCOUNT_PERCENTAGE', 0.10); // خصم 10% للطلبات الكبيرة

return [
    'database' => [
        'host' => 'localhost',
        'dbname' => 'mini_store',
        'username' => 'root',
        'password' => ''
    ],
    'logging' => [
        'enabled' => true,
        'file' => 'logs/transactions.log'
    ]
];