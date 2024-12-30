@extends('layouts.context')
@section('content')

<section class="page-banner">
    <div class="page-bg-wrapper p-r z-1 bg_cover pt-100 pb-110"
        style="background-image: url(assets/images/bg/page-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=== Page Banner Content ===-->
                    <div class="page-banner-content text-center">
                        <h1 class="page-title">Cart</h1>
                        <ul class="breadcrumb-link">
                            <li><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="active">Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Page Section ======-->
<!--====== Start Cart Section ======-->
<section class="cart-section pt-130 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div class="cart-wrapper wow fadeInUp">
                    <div class="cart-table table-responsive">
                        <table class="table">
                            <tbody id="cart-items">
                                <!-- Dynamically Generated Rows -->
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="shopping-cart-total mb-30 wow fadeInUp">
                    <h4 class="title">Cart Totals</h4>
                    <table class="table mb-25">
                        <tbody>
                            <td style="padding-right: 20px;">Items</td>
                            <td>
                                @foreach ($cart as $item)
                                {{ $item['name'] }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </td>
                            <tr>
                                <td>Cart Subtotal</td>
                                <td class="price" id="cart-subtotal">${{ number_format($cartSubtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Service Charge</td>
                                <td class="price">$50</td>
                            </tr>
                            <tr>
                                <td class="total"><span>Order Total</span></td>
                                <td class="total price" id="order-total"><span>${{ number_format($cartSubtotal + 50, 2)
                                        }}</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="theme-btn style-one" id="proceed-to-checkout" data-subtotal="{{ $cartSubtotal }}"
                        data-shipping="50" data-total="{{ $cartSubtotal + 50 }}"
                        data-items="{{ implode(',', array_column($cart, 'name')) }}">
                        Proceed to checkout
                    </button>

                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Cart Section ======-->
<script>
    let cart = [];

    function fetchCartItems() {
        fetch("{{ route('cart.items') }}")
            .then((response) => response.json())
            .then((data) => {
                cart = Object.values(data); // Convert object to array
                renderCart();
                updateTotals();
            })
            .catch((error) => console.error("Error fetching cart items:", error));
    }

    // Function to update cart table dynamically
    function renderCart() {
        const cartItemsContainer = document.getElementById("cart-items");
        cartItemsContainer.innerHTML = ""; // Clear current items

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <tr>
                    <td colspan="5">Your cart is empty!</td>
                </tr>
            `;
            updateTotals();
            return;
        }

        cart.forEach((item, index) => {
            cartItemsContainer.innerHTML += `
                <tr data-id="${index + 1}">
                    <td class="thumbnail-title">
                        <img src="${item.image}" alt="${item.name} Image">
                        <span class="title">${item.name}</span>
                    </td>
                    <td class="quantity">
                        <div class="quantity-input">
                            <button class="quantity-down" data-index="${index}"><i class="far fa-minus"></i></button>
                            <input class="quantity" type="text" value="${item.quantity}" readonly>
                            <button class="quantity-up" data-index="${index}"><i class="far fa-plus"></i></button>
                        </div>
                    </td>
                    <td class="subtotal">$${(item.price * item.quantity).toFixed(2)}</td>
                    <td class="remove">
                        <button class="remove-item" data-index="${index}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            `;
        });
    }

    // Function to update totals dynamically
    function updateTotals() {
        const cartSubtotal = cart.reduce((total, item) => total + item.price * item.quantity, 0);
        const shippingFee = 50; // Static shipping fee
        const orderTotal = cartSubtotal + shippingFee;

        document.getElementById("cart-subtotal").textContent = `$${cartSubtotal.toFixed(2)}`;
        document.getElementById("order-total").textContent = `$${orderTotal.toFixed(2)}`;
    }

    // Update session with new quantity
    function updateSessionQuantity(itemId, newQuantity) {
        fetch("{{ route('cart.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: itemId, quantity: newQuantity })
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    console.log("Session updated successfully");
                } else {
                    console.error("Failed to update session");
                }
            })
            .catch((error) => console.error("Error updating session:", error));
    }

    // Event listeners for cart actions
    document.getElementById("cart-items").addEventListener("click", (event) => {
        const index = event.target.closest("button")?.dataset.index;

        if (event.target.closest(".quantity-up")) {
            cart[index].quantity++;
            updateSessionQuantity(cart[index].id, cart[index].quantity);
            renderCart();
            updateTotals();
        } else if (event.target.closest(".quantity-down")) {
            if (cart[index].quantity > 1) {
                cart[index].quantity--;
                updateSessionQuantity(cart[index].id, cart[index].quantity);
            }
            renderCart();
            updateTotals();
        } else if (event.target.closest(".remove-item")) {
            updateSessionQuantity(cart[index].id, 0); // Set quantity to 0 to remove`
            cart.splice(index, 1); // Remove item from cart
            renderCart();
            updateTotals();
        }
    });

    // Initial render
    fetchCartItems();
</script>

<script>
    document.getElementById('proceed-to-checkout').addEventListener('click', function () {
        // Get values from data attributes
        const cartSubtotal = this.getAttribute('data-subtotal');
        const shippingFee = this.getAttribute('data-shipping');
        const orderTotal = this.getAttribute('data-total');
        const itemNames = this.getAttribute('data-items');

        // Redirect to the checkout page with query parameters
        window.location.href = `/checkout?subtotal=${cartSubtotal}&shipping=${shippingFee}&total=${orderTotal}&items=${encodeURIComponent(itemNames)}`;
    });
</script>



@endsection