@extends('layouts.context')
@section('content')

<section class="page-banner">
    <div class="page-bg-wrapper p-r z-1 bg_cover pt-100 pb-110" style="background-image: url(assets/images/bg/page-bg.jpg);">
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
</section><!--====== End Page Section ======-->
<!--====== Start Checkout Section ======-->
<section class="checkout-section pt-130 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="checkout-faqs wow fadeInUp" id="checkout-faq">
                    <div class="alert gray-bg">
                        <h6>Returning customer? <button class="collapsed card-header" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse0">Click here</button></h6>
                        <div id="collapse3" class="collapse" data-bs-parent="checkout-faq">
                            <form>
                                <p>Please login your accont.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" id="email-address" name="email-address" class="form_control" value="" placeholder="Your Email Address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" id="password" name="password" class="form_control" value="" placeholder="Your Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer d-flex align-items-center">
                                    <button type="submit" class="theme-btn style-one">login</button>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="loss-passowrd">
                                        <label class="form-check-label" for="loss-passowrd">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <a href="checkout.html" class="cl-pass">Lost your password?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!--=== Checkout Wrapper ===-->
                <div class="checkout-wrapper mt-50 wow fadeInUp">
                    <!--=== Checkout Form ===-->
                    <form class="checkout-form">
                        <div class="row">
                            <div class="col-xl-8">
                                <h4 class="title mb-15">Billing Details</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form_group">
                                            <label>First Name*</label>
                                            <input type="text" class="form_control" placeholder="First Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form_group">
                                            <label>Last Name*</label>
                                            <input type="text" class="form_control" placeholder="Last Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form_group">
                                            <label>Company Name</label>
                                            <input type="text" class="form_control" placeholder="Your Company Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form_group">
                                            <label>Address*</label>
                                            <input type="text" class="form_control" placeholder="Street Address" required>
                                            <input type="text" class="form_control" placeholder="Apartment, suite, unit etc. (optional)" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form_group">
                                            <label>Town / City*</label>
                                            <input type="text" class="form_control" placeholder="Town / City" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form_group">
                                            <label>Country*</label>
                                            <input type="text" class="form_control" placeholder="United Kingdom (UK)" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form_group">
                                            <label>Postcode / Zip*</label>
                                            <input type="text" class="form_control" placeholder="Postcode / Zip" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form_group">
                                            <label>Contact Info*</label>
                                            <input type="email" class="form_control" placeholder="Email Address" name="email" required>
                                            <input type="text" class="form_control" placeholder="Your Phone" name="number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form_group">
                                            <label>Order Notes (optional)</label>
                                            <textarea name="order-note" class="form_control" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="shopping-cart-area mb-50 wow fadeInDown">
                                    <h4 class="title mb-15">Your order</h4>
                                    <div class="shopping-cart-total">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Cart Subtotal</td>
                                                    <td class="price">$270</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Fee</td>
                                                    <td class="price">$50</td>
                                                </tr>
                                                <tr>
                                                    <td class="total"><span>Order Total</span></td>
                                                    <td class="total price"><span>$320</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="accordion-td">
                                                        <div class="form_group" id="accordion-coupon">
                                                            <label data-bs-toggle="collapse" data-bs-target="#collapse01">Have A Coupon ?</label>
                                                            <div id="collapse01" class="collapse" data-bs-parent="#paymentMethod">
                                                                <input type="text" class="form_control" placeholder="Coupon Code">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button class="theme-btn style-one">Proceed to checkout</button>
                                    </div>
                                </div>
                                <!--=== Payment Method ===-->
                                <div class="payment-method mb-30 wow fadeInDown">
                                    <h4 class="title mb-20">Payment Method</h4>
                                    <ul id="paymentMethod" class="mb-20">
                                        <!-- Default unchecked -->
                                        <li class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="method1" checked>
                                            <label class="form-check-label" for="method1" data-bs-toggle="collapse" data-bs-target="#collapse0">Cash On Delivery</label>
                                            <div id="collapse0" class="collapse show" data-bs-parent="#paymentMethod">
                                                <p>Pay with cash remains a simple and reliable choice, transcending the complexities of modern finance.</p>
                                            </div>
                                        </li>
                                        <!-- Default unchecked -->
                                        <li class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="method2">
                                            <label class="form-check-label" for="method2" data-bs-toggle="collapse" data-bs-target="#collapse1">Direct Bank Transfer</label>
                                            <div id="collapse1" class="collapse" data-bs-parent="#paymentMethod">
                                                <p>Please proceed with your payment directly into our bank account. Kindly use your Order ID as the payment reference. Your order will be processed once the payment reflects in our account.</p>
                                            </div>
                                        </li>
                                        <!-- Default unchecked -->
                                        <li class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="method3">
                                            <label class="form-check-label" for="method3" data-bs-toggle="collapse" data-bs-target="#collapse2">Paypal</label>
                                            <div id="collapse2" class="collapse" data-bs-parent="#paymentMethod">
                                                <p>You can make your payment via PayPal. If you don't have a PayPal account, you can use your credit card to complete the transaction.</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <p>We will utilize your personal data to process your order, enhance your experience on our website, and for other purposes outlined in our <a href="#">privacy policy</a>.</p>
                                    <button class="theme-btn style-one">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!--====== End Checkout Section ======-->

@endsection