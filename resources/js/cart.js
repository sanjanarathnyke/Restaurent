// Function to update the cart totals based on current quantities
function updateCartTotals() {
    let cartSubtotal = 0;
    // Loop through each item's subtotal and accumulate the total
    document.querySelectorAll('tr').forEach(row => {
        const subtotal = row.querySelector('.subtotal');
        if (subtotal) {
            cartSubtotal += parseFloat(subtotal.getAttribute('data-subtotal'));
        }
    });

    // Update the cart subtotal and order total
    document.getElementById('cart-subtotal').innerText = `$${cartSubtotal.toFixed(2)}`;
    const shippingFee = 50; // Fixed shipping fee
    const orderTotal = cartSubtotal + shippingFee;
    document.getElementById('order-total').innerText = `$${orderTotal.toFixed(2)}`;
}

// Function to handle increasing the quantity
function increaseQuantity(button) {
    const quantityInput = button.previousElementSibling;
    let quantity = parseInt(quantityInput.value, 10); // Get current quantity as integer
    quantity += 1; // Increment by 1
    quantityInput.value = quantity; // Set updated value back to input

    const price = parseFloat(button.getAttribute('data-price')); // Get the item's price
    const subtotal = (price * quantity).toFixed(2); // Calculate new subtotal
    const subtotalElement = button.closest('tr').querySelector('.subtotal');
    subtotalElement.innerText = `$${subtotal}`;
    subtotalElement.setAttribute('data-subtotal', subtotal);

    updateCartTotals(); // Recalculate cart totals
}

// Function to handle decreasing the quantity
function decreaseQuantity(button) {
    const quantityInput = button.nextElementSibling;
    let quantity = parseInt(quantityInput.value, 10); // Get current quantity as integer
    if (quantity > 1) { // Ensure quantity stays above 1
        quantity -= 1; // Decrement by 1
        quantityInput.value = quantity; // Set updated value back to input

        const price = parseFloat(button.getAttribute('data-price')); // Get the item's price
        const subtotal = (price * quantity).toFixed(2); // Calculate new subtotal
        const subtotalElement = button.closest('tr').querySelector('.subtotal');
        subtotalElement.innerText = `$${subtotal}`;
        subtotalElement.setAttribute('data-subtotal', subtotal);

        updateCartTotals(); // Recalculate cart totals
    }
}

// Detach any existing event listeners and re-attach event listeners to the quantity buttons
function attachEventListeners() {
    // Remove existing listeners to avoid double counting
    document.querySelectorAll('.quantity-up').forEach(button => {
        button.removeEventListener('click', increaseQuantity);
        button.addEventListener('click', function() {
            increaseQuantity(this); // Increase quantity on click
        });
    });

    document.querySelectorAll('.quantity-down').forEach(button => {
        button.removeEventListener('click', decreaseQuantity);
        button.addEventListener('click', function() {
            decreaseQuantity(this); // Decrease quantity on click
        });
    });
}

// Attach event listeners on page load
window.addEventListener('DOMContentLoaded', (event) => {
    attachEventListeners(); // Attach the listeners to the quantity buttons
});

// Optional: Update cart on button click (if necessary)
document.getElementById('update-cart').addEventListener('click', function() {
    // Implement AJAX call here if needed to update server-side cart
    updateCartTotals(); // Update totals on button click
});
