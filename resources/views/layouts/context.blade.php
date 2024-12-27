<!DOCTYPE html>
<html lang="zxx">
    <head>
        <!--====== Required meta tags ======-->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="fast food, burger, pizza">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--====== Title ======-->
        <title>Foodix - Fast Foods & Restaurants HTML Template</title>
        <!--====== Favicon Icon ======-->
        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
        <!--====== Google Fonts ======-->
        <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700;800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <!--====== FontAwesome css ======-->
        <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.min.css">
        <!--====== Bootstrap css ======-->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <!--====== Slick-popup css ======-->
        <link rel="stylesheet" href="assets/vendor/slick/slick.css">
        <!--====== Nice Select css ======-->
        <link rel="stylesheet" href="assets/vendor/nice-select/css/nice-select.css">
        <!--====== magnific-popup css ======-->
        <link rel="stylesheet" href="assets/vendor/magnific-popup/dist/magnific-popup.css">
        <!--====== Jquery UI css ======-->
        <link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.min.css">
        <!--====== Animate css ======-->
        <link rel="stylesheet" href="assets/vendor/animate.css">
        <!--====== Default css ======-->
        <link rel="stylesheet" href="assets/css/default.css">
        <!--====== Style css ======-->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
        <!--====== Start Loader Area ======-->
        <div class="fd-preloader">
            <div class="loader"></div>
        </div><!--====== End Loader Area ======-->
        <!--====== Start Overlay ======-->
        <div class="offcanvas__overlay"></div>
        <!--====== End Overlay ======-->
        <!--====== Start Sidemenu-wrapper-cart Area ======-->
        <div class="sidemenu-wrapper-cart">
            <div class="sidemenu-content">
                <div class="widget widget-shopping-cart">
                    <h4>My cart</h4>
                    <div class="sidemenu-cart-close"><i class="far fa-times"></i></div>
                    <div class="widget-shopping-cart-content">
                        <ul class="foodix-mini-cart-list">
                            @if(session('cart') && count(session('cart')) > 0)
                                @foreach(session('cart') as $id => $item)  <!-- Use $id as the key -->
                                    <li class="foodix-menu-cart">
                                        <a href="{{ route('cart.remove', $id) }}" class="remove-cart"><i class="far fa-trash-alt"></i></a> <!-- Use $id here -->
                                        <a href="#">
                                            <img src="{{ $item['image'] }}" alt="cart image">
                                            {{ $item['name'] }}
                                        </a>
                                        <span class="quantity">{{ $item['quantity'] }} × <span><span class="currency">$</span>{{ number_format($item['price'], 2) }}</span></span>
                                    </li>
                                @endforeach
                            @else
                                <li class="foodix-menu-cart">Your cart is empty.</li>
                            @endif
                        </ul>
                        <div class="cart-mini-total">
                            <div class="cart-total">
                                <span><strong>Subtotal:</strong></span> <span class="amount">1 × <span><span class="currency">$</span>940.00</span></span>
                            </div>
                        </div>
                        <div class="cart-button">
                            <a href="checkout.html" class="theme-btn style-one">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--====== End Sidemenu-wrapper-cart Area ======-->
        <!--====== Start Header Area ======-->
        <header class="header-area header-one navigation-white transparent-header">
            <div class="container">
                <div class="header-navigation">
                    <div class="nav-overlay"></div>
                    <div class="primary-menu">
                        <!--=== Site Branding ===-->
                        <div class="site-branding">
                            <a href="index.html" class="brand-logo"><img src="assets/images/logo/logo-white.png" alt="Logo"></a>
                        </div>
                        <div class="nav-inner-menu">
                            <!--=== Foodix Nav Menu ===-->
                            <div class="foodix-nav-menu">
                                <!--=== Mobile Logo ===-->
                                <div class="mobile-logo mb-30 d-block d-xl-none text-center">
                                    <a href="index.html" class="brand-logo"><img src="assets/images/logo/logo-main.png" alt="Site Logo"></a>
                                </div>
                                <!--=== Main Menu ===-->
                                <nav class="main-menu">
                                    <ul>
                                        <li class="menu-item has-children"><a href="{{ route('welcome') }}">Home</a>

                                        </li>
                                        <li class="menu-item has-children"><a href="{{ route('menu') }}">Menu</a>

                                        </li>
                                        <li class="menu-item has-children"><a href="{{ route('cart.show') }}">cart</a>

                                        </li>
                                        <li class="menu-item has-children"><a href="{{ route('checkout') }}">checkout</a>

                                        </li>

                                    </ul>
                                </nav>
                                <!--=== Nav Button ===-->
                                <div class="nav-button mt-50 d-block d-xl-none  text-center">
                                    <a href="contact.html" class="theme-btn style-one">Book A Table</a>
                                </div>
                            </div>
                            <!--=== Nav Right Item ===-->
                            <div class="nav-right-item">

                                <div class="cart-button">
                                    <i class="far fa-shopping-cart"></i>
                                </div>
                                <div class="navbar-toggler">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header><!--====== End Header Area ======-->
        <!--====== Start Hero Section ======-->

        @yield('content')

        <!--====== Start Footer ======-->
        <footer class="footer-default p-r z-1">
            <div class="footer-shape f-shape_one scene"><span data-depth=".3"><img src="assets/images/shape/shape-2.png" alt="shape"></span></div>
            <div class="footer-shape f-shape_two scene"><span data-depth=".4"><img src="assets/images/shape/shape-3.png" alt="shape"></span></div>
            <div class="footer-shape f-shape_three scene"><span data-depth=".5"><img src="assets/images/shape/shape-4.png" alt="shape"></span></div>
            <div class="footer-shape f-shape_four scene"><span data-depth=".6"><img src="assets/images/shape/shape-5.png" alt="shape"></span></div>
            <div class="footer-shape f-shape_five scene"><span data-depth=".7"><img src="assets/images/shape/shape-6.png" alt="shape"></span></div>
            <div class="footer-shape f-shape_six scene"><span data-depth=".8"><img src="assets/images/shape/shape-7.png" alt="shape"></span></div>
            <div class="footer-shape f-shape_seven scene"><span data-depth=".9"><img src="assets/images/shape/shape-8.png" alt="shape"></span></div>
            <div class="container">
                <!--=== Footer Widget Area ===-->
                <div class="footer-widget-area pt-120 pb-75">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!--=== Footer Widget ===-->
                            <div class="footer-widget footer-about-widget mb-40 wow fadeInUp">
                                <div class="widget-content">
                                    <div class="footer-logo mb-25">
                                        <a href="index.html"><img src="assets/images/logo/logo-white.png" alt="Brand Logo"></a>
                                    </div>
                                    <p>Discover culinary delights recipes
                                        and inspiration in our delightful
                                        food haven..</p>
                                    <ul class="social-link">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!--=== Footer Widget ===-->
                            <div class="footer-widget footer-contact-widget mb-40 wow fadeInUp">
                                <div class="widget-content">
                                    <h4 class="widget-title">Contact Us</h4>
                                    <ul class="address-list">
                                        <li>1901 Thornridge Cir. Shiloh, Hawaii 81063</li>
                                        <li><a href="tel:+88-344-667-999">+88-344-667-999</a></li>
                                        <li><a href="mailto:order@barger.com">order@foodix.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!--=== Footer Widget ===-->
                            <div class="footer-widget footer-nav-widget mb-40 wow fadeInUp">
                                <div class="widget-content">
                                    <h4 class="widget-title">Branches</h4>
                                    <ul class="widget-menu">
                                        <li>KANDY</a></li>
                                        <li>PERADENIYA</li>
                                        <li>COLOMBO</a></li>
                                        <li>GALLE</li>
                                        <li>NUWARAELIYA</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!--=== Footer Widget ===-->
                            <div class="footer-widget footer-opening-widget mb-40 wow fadeInUp">
                                <div class="widget-content">
                                    <h4 class="widget-title">Opining time</h4>
                                    <ul class="opening-schedule">
                                        <li>Monday<span>: 10.00am - 05.00pm </span></li>
                                        <li>Tuesday<span>: 10.20am - 05.30pm </span></li>
                                        <li>Wednesday<span>: 10.30am - 05.50pm </span></li>
                                        <li>Thursday<span>: 11.00am - 07.10pm </span></li>
                                        <li>Friday<span class="of-close">: Closed</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=== Copyright Area ===-->
            <div class="copyright-area text-center">
                <div class="container">
                    <div class="copyright-text">
                        <p>&copy; 2024 All rights reserved design by Pixelfit</p>
                    </div>
                </div>
            </div>
        </footer><!--====== End Footer ======-->
        <!--====== Back To Top  ======-->
        <a href="#" class="back-to-top" ><i class="far fa-angle-up"></i></a>
        <!--====== Jquery js ======-->
        <script src="assets/vendor/jquery-3.6.0.min.js"></script>
        <!--====== Popper js ======-->
        <script src="assets/vendor/popper/popper.min.js"></script>
        <!--====== Bootstrap js ======-->
        <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--====== Slick js ======-->
        <script src="assets/vendor/slick/slick.min.js"></script>
        <!--====== Magnific js ======-->
        <script src="assets/vendor/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
        <!--====== Nice-select js ======-->
        <script src="assets/vendor/nice-select/js/jquery.nice-select.min.js"></script>
        <!--====== Parallax js ======-->
        <script src="assets/vendor/parallax.min.js"></script>
        <!--====== jquery UI js ======-->
        <script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
        <!--====== WOW js ======-->
        <script src="assets/vendor/wow.min.js"></script>
        <!--====== Main js ======-->
        <script src="assets/js/theme.js"></script>
    </body>
</html>
