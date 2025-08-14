<?php
spl_autoload_register(function ($class) {
    // استبدال "\" بالـ "/" لتحديد مسار الملف
    $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});
