// نموذج بسيط لعرض المنتجات وإدارة السلة
document.addEventListener('DOMContentLoaded', function() {
    // بيانات المنتجات (في الواقع ستأتي من PHP)
    const products = [
        { id: 'P001', name: 'Laptop', price: 999.99, stock: 10 },
        { id: 'P002', name: 'Smartphone', price: 499.99, stock: 20 },
        { id: 'P003', name: 'Headphones', price: 99.99, stock: 30 }
    ];
    
    const cart = [];
    
    // عرض المنتجات
    const productsContainer = document.getElementById('products');
    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.className = 'product';
        productDiv.innerHTML = `
            <h3>${product.name}</h3>
            <p>Price: $${product.price.toFixed(2)}</p>
            <p>Stock: ${product.stock}</p>
            <button onclick="addToCart('${product.id}')">Add to Cart</button>
        `;
        productsContainer.appendChild(productDiv);
    });
    
    // إضافة إلى السلة
    window.addToCart = function(productId) {
        const product = products.find(p => p.id === productId);
        if (product) {
            cart.push(product);
            updateCart();
        }
    };
    
    // تحديث السلة
    function updateCart() {
        const cartItems = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');
        
        cartItems.innerHTML = '';
        let total = 0;
        
        cart.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.textContent = `${item.name} - $${item.price.toFixed(2)}`;
            cartItems.appendChild(itemDiv);
            total += item.price;
        });
        
        cartTotal.textContent = `Total: $${total.toFixed(2)}`;
    }
    
    // معالجة الدفع
    document.getElementById('checkout-btn').addEventListener('click', function() {
        if (cart.length === 0) {
            alert('Your cart is empty');
            return;
        }
        
        // هنا ستقوم بإرسال البيانات إلى PHP لمعالجة الطلب
        alert('Order submitted! Check the PHP console for details.');
    });
});