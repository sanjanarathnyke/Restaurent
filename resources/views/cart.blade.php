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
                            <tbody>
                                @if (session('cart'))
                                @foreach (session('cart') as $id => $details)
                                <tr>
                                    <td class="thumbnail-title">
                                        <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }} Image">
                                        <span class="title">{{ $details['name'] }}</span>
                                    </td>

                                    <td class="quantity">
                                        <div class="quantity-input">
                                            <button class="quantity-down"><i class="far fa-minus"></i></button>
                                            <input class="quantity" type="text" value="{{ $details['quantity'] }}"
                                                name="quantity" readonly>
                                            <button class="quantity-up"><i class="far fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td class="subtotal">${{ number_format($details['price'] * $details['quantity'], 2)
                                        }}</td>
                                    <td class="remove">
                                        <a href="{{ route('cart.remove', $id) }}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">Your cart is empty!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="cart-middle mt-40 wow fadeInUp">
                    <div class="row">
                        <div class="col-lg-7">

                            <div class="col-lg-5">
                                <div class="update-cart float-lg-right mb-30">
                                    <button class="theme-btn style-one" id="update-cart">Update Cart</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="shopping-cart-total mb-30 wow fadeInUp">
                    <h4 class="title">Cart Totals</h4>
                    <table class="table mb-25">
                        <tbody>
                            <tr>
                                <td>Cart Subtotal</td>
                                <td class="price" id="cart-subtotal">${{ number_format($cartSubtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Shipping Fee</td>
                                <td class="price">$50</td>
                            </tr>
                            <tr>
                                <td class="total"><span>Order Total</span></td>
                                <td class="total price" id="order-total"><span>${{ number_format($cartSubtotal + 50, 2)
                                        }}</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <script>
                        // Function to update the cart total and order total
                        function updateCartTotal() {
                            let cartSubtotal = 0;
                        
                            // Loop through each row and add up the subtotal
                            document.querySelectorAll('tr').forEach(row => {
                                let subtotalText = row.querySelector('.subtotal').textContent;
                                let subtotal = parseFloat(subtotalText.replace('$', '').replace(',', '')); // Get subtotal value
                        
                                // Check if subtotal is a valid number
                                if (!isNaN(subtotal)) {
                                    cartSubtotal += subtotal; // Aggregate subtotal
                                }
                            });
                        
                            // Update the cart subtotal in the DOM
                            document.getElementById('cart-subtotal').textContent = `$${cartSubtotal.toFixed(2)}`;
                        
                            // Shipping fee (fixed value)
                            let shippingFee = 50;
                        
                            // Calculate the order total (cart subtotal + shipping fee)
                            let orderTotal = cartSubtotal + shippingFee;
                        
                            // Update the order total in the DOM
                            document.getElementById('order-total').textContent = `$${orderTotal.toFixed(2)}`;
                        }
                        
                        // Update cart button click event
                        document.getElementById('update-cart').addEventListener('click', function (e) {
                            e.preventDefault();
                            console.log('Update Cart button clicked');
                        
                            let cartData = [];
                        
                            // Loop through each cart row and collect the item id and updated quantity
                            document.querySelectorAll('tr').forEach(row => {
                                let itemId = row.dataset.id; // Get the item ID from data-id attribute
                        
                                // Find the input field inside the row for quantity
                                let quantityInput = row.querySelector('.quantity-input input');
                                
                                // Check if the quantity input field exists
                                if (quantityInput) {
                                    let quantity = parseInt(quantityInput.value); // Get the current quantity
                        
                                    // Push the item data into the cartData array
                                    cartData.push({
                                        id: itemId,
                                        quantity: quantity
                                    });
                                } else {
                                    console.log('Quantity input not found for row with ID:', itemId);
                                }
                            });
                        
                            // Send updated cart data to the server
                            updateCartItems(cartData);
                        
                            // Recalculate the totals
                            updateCartTotal(); // Recalculate totals after sending update
                        });
                        
                        // Function to send updated cart items to the server
                        function updateCartItems(cartData) {
                            fetch(`/cart/update-multiple`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    items: cartData
                                })
                            }).then(response => response.json())
                              .then(data => {
                                  if (data.success) {
                                      console.log('Cart updated successfully');
                                      // After a successful response, update totals again
                                      updateCartTotal(); // Update totals again after successful response
                                  }
                              }).catch(error => console.log('Error:', error));
                        }
                    </script>

                    <button class="theme-btn style-one">Proceed to checkout</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Cart Section ======-->

@endsection