/*-----------------------------------------------------------------------------------
    
Template Name: Foodix - Fast Foods & Restaurants HTML Template
URI: site.com 
Description: Foodix is a versatile and innovative website template tailored for a wide range of food-related businesses including restaurants, cafes, pubs, fast food outlets, bistros, bakeries, and more. Whether you specialize in pizzas, burgers, coffees, or offer food booking services, Foodix is designed to meet your needs with its clean and creative layout.This is highly customizable and looks awesome on tablets and mobile devices. We have included best practices of web development and you can create a great website layout based on Bootstrap or Grid 1320px.
Author: Pixelfit
Author URI: https://themeforest.net/user/pixelfit
Version: 1.0 

    Note: This is Main Js file
-----------------------------------------------------------------------------------
    Js INDEX
    ===================
    ## Main Menu
    ## Document Ready
    ## Nav Overlay
    ## Preloader
    ## Sticky
    ## Back to top
    ## Magnific-popup js
    ## Nice select
    ## Slick Slider
    ## Quantity Number js
    ## Parallax js
    ## Datepicker js
    ## WOW Js
    
-----------------------------------------------------------------------------------*/

(function($) {
    'use strict';

    //===== Main Menu
    function mainMenu() {
        
        // Variables
        var var_window = $(window),
        navContainer = $('.header-navigation'),
        navbarToggler = $('.navbar-toggler'),
        navMenu = $('.foodix-nav-menu'),
        navMenuLi = $('.foodix-nav-menu ul li ul li'),
        closeIcon = $('.navbar-close');

        // navbar toggler

        navbarToggler.on('click', function() {
            navbarToggler.toggleClass('active');
            navMenu.toggleClass('menu-on');
        });

        // close icon

        closeIcon.on('click', function() {
            navMenu.removeClass('menu-on');
            navbarToggler.removeClass('active');
        });

        // adds toggle button to li items that have children

        navMenu.find("li a").each(function() {
            if ($(this).children('.dd-trigger').length < 1) {
                if ($(this).next().length > 0) {
                    $(this).append('<span class="dd-trigger"><i class="far fa-angle-down"></i></span>')
                }
            }
        });

        // expands the dropdown menu on each click

        navMenu.find(".dd-trigger").on('click', function(e) {
            e.preventDefault();
            $(this).parent().parent().siblings().children('ul.sub-menu').slideUp();
            $(this).parent().next('ul.sub-menu').stop(!0, !0).slideToggle(350);
            $(this).toggleClass('sub-menu-open')
        });

        // check browser width in real-time

    };

    // Document Ready

    $(document).ready(function() {
        mainMenu();
    });


    // Offcanvas Overlay

    $(".cart-button").on("click", function() {
        $(".sidemenu-wrapper-cart").addClass("info-open");
    });
    $(".navbar-toggler, .offcanvas__overlay,.cart-button").on('click', function (e) {
        $(".offcanvas__overlay").toggleClass("overlay-open");
    });
    $(".offcanvas__overlay").on('click', function (e) {
        $(".navbar-toggler").removeClass("active");
        $(".foodix-nav-menu").removeClass("menu-on");
        $(".sidemenu-wrapper-cart").removeClass("info-open");
    }); 
    $(".sidemenu-cart-close").on("click", function() {
        $(".sidemenu-wrapper-cart").removeClass("info-open");
        $(".offcanvas__overlay").removeClass("overlay-open");
    });

    //===== Preloader
    
    $(window).on('load', function(event) {
        $('.fd-preloader').delay(400).fadeOut('400');
    })
    
    //===== Sticky

    $(window).on('scroll', function(event) {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".header-area").removeClass("sticky");
        } else {
            $(".header-area").addClass("sticky");
        }
    });

    //===== Back to top

    $(window).on('scroll', function(event) {
        if ($(this).scrollTop() > 600) {
            $('.back-to-top').fadeIn(200)
        } else {
            $('.back-to-top').fadeOut(200)
        }
    });
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });

    //===== Magnific-popup js
    
    if ($('.video-popup').length){
        $('.video-popup').magnificPopup({
            type: 'iframe',
            removalDelay: 300,
            mainClass: 'mfp-fade'
        });
    }

    if ($('.img-popup').length){
        $(".img-popup").magnificPopup({
            type: "image",
             gallery: { 
              enabled: true 
            }
        });
    }

    //===== Nice select js
    
    if ($('select').length){
        $('select').niceSelect();
    }
    
    //===== Slick slider js
    if ($('.testimonial-slider-one').length) {
        $('.testimonial-slider-one').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 800,
            autoplay: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
    if ($('.testimonial-slider-two').length) {
        $('.testimonial-slider-two').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 800,
            autoplay: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
    if ($('.special-off-slider').length) {
        $('.special-off-slider').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 800,
            autoplay: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><span><i class="far fa-arrow-left"></i></span></div>',
            nextArrow: '<div class="next"><span><i class="far fa-arrow-right"></i></span></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }
    if ($('.gallery-slider-one').length) {
        $('.gallery-slider-one').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 800,
            autoplay: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3    
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3    
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2   
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1   
                    }
                }
            ]
        });
    }
    if ($('.gallery-slider-two').length) {
        $('.gallery-slider-two').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 800,
            autoplay: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3    
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2   
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 1   
                    }
                }
            ]
        });
    }
    if ($('.instagram-slider-one').length) {
        $('.instagram-slider-one').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 800,
            autoplay: true,
            slidesToShow: 6,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4    
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3    
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2   
                    }
                }
            ]
        });
    }
    if ($('.instagram-slider-two').length) {
        $('.instagram-slider-two').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 800,
            autoplay: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            prevArrow: '<div class="prev"><i class="far fa-arrow-left"></i></div>',
            nextArrow: '<div class="next"><i class="far fa-arrow-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4    
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3    
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2   
                    }
                }
            ]
        });
    }
    //======= Quantity Number js
    
    $('.quantity-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 1) $(this).next().val(numProduct - 1);
    });
    $('.quantity-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    //====== Parallax js

    $('.scene').each(function () {
        new Parallax($(this)[0]);
    });


    //===== Datepicker
    $( function() {
        $( "#datepicker" ).datepicker();
    } );


    //===== Simply Countdown

    if ($('.simply-countdown').length){
        simplyCountdown('.simply-countdown', {
            year: 2024,
            month: 9,
            day: 30,
            words: { //words displayed into the countdown
                days: { singular: 'day', plural: 'Days' },
                hours: { singular: 'hour', plural: 'Hours' },
                minutes: { singular: 'minute', plural: 'Min' },
                seconds: { singular: 'second', plural: 'Sec' }
            },
        });
    }

    //===== Wow js
    
    new WOW().init();
    

})(window.jQuery);