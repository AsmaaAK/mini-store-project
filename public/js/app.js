let cart = [];

// function addToCart(productId) {
//     // إرسال طلب AJAX لإضافة المنتج
//     fetch('/add-to-cart.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({ productId: productId })
//     })
//     .then(response => response.json())
//     .then(data => {
//         updateCartUI(data.cart);
//     });
// }
function addToCart(productId) {
    const quantity = prompt("Enter quantity:", "1");
    if (quantity && quantity > 0) {
        document.querySelector(`input[name="products[${productId}]"]`).value = quantity;
        alert("Product added to cart!");
    }
}
function updateCartUI(cartData) {
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    
    cartItems.innerHTML = '';
    let total = 0;
    
    cartData.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.textContent = `${item.name} - $${item.price.toFixed(2)}`;
        cartItems.appendChild(itemDiv);
        total += item.price;
    });
    
    cartTotal.textContent = `Total: $${total.toFixed(2)}`;
}

document.getElementById('checkout-btn').addEventListener('click', checkout);

function checkout() {
    fetch('/checkout.php', {
        method: 'POST',
        body: JSON.stringify({ cart: cart })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        cart = [];
        updateCartUI([]);
    });
}