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
                        <h1 class="page-title">Checkout</h1>
                        <ul class="breadcrumb-link">
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Page Section ======-->
<!--====== Start Checkout Section ======-->
<section class="checkout-section pt-130 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--=== Checkout Wrapper ===-->
                <div class="checkout-wrapper mt-50 wow fadeInUp">
                    <!--=== Checkout Form ===-->
                    <form class="checkout-form">
                        <div class="row">
                            {{--customer informations start---}}
                            <div class="col-xl-8">
                                <h4 class="title mb-15">Billing Details</h4>
                                <form action="{{ route('consumer.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form_group">
                                                <label>First Name</label>
                                                <input type="text" class="form_control" name="first_name" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form_group">
                                                <label>Last Name</label>
                                                <input type="text" class="form_control" name="last_name" placeholder="Last Name" required>
                                            </div>
                                        </div>                              
                                        <div class="col-lg-12">
                                            <div class="form_group">
                                                <label>City</label>
                                                <select class="form_control" name="city" required>
                                                    <option value="">Select City</option>
                                                    <option value="kd">Kandy</option>
                                                    <option value="cmb">Colombo</option>
                                                    <option value="per">Peradeniya</option>
                                                    <option value="ne">Nuwaraeliya</option>
                                                    <option value="gl">Galle</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">            
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form_group">
                                                <label>Contact Info</label>
                                                <input type="email" class="form_control" name="email" placeholder="Email Address" required>
                                                <input type="text" class="form_control" name="phone" placeholder="Your Phone" required>
                                            </div>
                                        </div>                           
                                        <div class="col-lg-12">
                                            <button type="submit" class="theme-btn style-one">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                            {{--customer information ends--}}

                            {{--checkout section--}}
                            <div class="col-xl-4">
                                {{---form that needs to submit--}}
                                <div class="shopping-cart-area mb-50 wow fadeInDown">
                                    <h4 class="title mb-15">Your order</h4>
                                    <div class="shopping-cart-total">
                                        <table class="table" style="border-spacing: 0 15px; border-collapse: separate;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding-right: 20px;">Item Name</td>
                                                    <td>
                                                        @foreach ($itemNames as $name)
                                                            {{ $name }}{{ !$loop->last ? ', ' : '' }}
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-right: 20px;">Cart Subtotal</td>
                                                    <td class="price">${{ number_format($subtotal, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-right: 20px;">Service Charge</td>
                                                    <td class="price">$50</td>
                                                </tr>
                                                <tr>
                                                    <td class="total" style="padding-right: 20px;"><span>Order Total</span></td>
                                                    <td class="total price"><span>${{ number_format($total, 2) }}</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                

                                <!--=== Payment Method ===-->
                                <form action="{{ route('showbill') }}" method="GET" target="_blank">
                                    <div class="payment-method mb-30 wow fadeInDown">
                                        <h4 class="title mb-20">Payment Method</h4>
                                        <ul id="paymentMethod" class="mb-20">
                                            <!-- Cash On Delivery -->
                                            <li class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    value="Cash On Delivery" id="method1" checked>
                                                <label class="form-check-label" for="method1" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse0">Cash On Delivery</label>
                                                <div id="collapse0" class="collapse show"
                                                    data-bs-parent="#paymentMethod">
                                                    <p>Pay with cash remains a simple and reliable choice, transcending
                                                        the complexities of modern finance.</p>
                                                </div>
                                            </li>
                                            <!-- Direct Bank Transfer -->
                                            <li class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    value="Direct Bank Transfer" id="method2">
                                                <label class="form-check-label" for="method2" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse1">Direct Bank Transfer</label>
                                                <div id="collapse1" class="collapse" data-bs-parent="#paymentMethod">
                                                    <p>Please proceed with your payment directly into our bank account.
                                                        Kindly use your Order ID as the payment reference. Your order
                                                        will be processed once the payment reflects in our account.</p>
                                                </div>
                                            </li>
                                            <!-- Paypal -->
                                            <li class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    value="Paypal" id="method3">
                                                <label class="form-check-label" for="method3" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse2">Paypal</label>
                                                <div id="collapse2" class="collapse" data-bs-parent="#paymentMethod">
                                                    <p>You can make your payment via PayPal. If you don't have a PayPal
                                                        account, you can use your credit card to complete the
                                                        transaction.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <p>We will utilize your personal data to process your order, enhance your
                                            experience on our website, and for other purposes outlined in our <a
                                                href="#">privacy policy</a>.</p>
                                        <button type="submit" class="theme-btn style-one">Place Order</button>
                                    </div>
                                </form>



                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Checkout Section ======-->
<script>
    document.querySelector("form").addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);

        fetch("{{ route('consumer.store') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Form submitted successfully! check your email to furhter informations");

                    this.reset();
                    // Optionally redirect or clear the form
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
</script>



@endsection