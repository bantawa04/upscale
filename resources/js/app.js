require('./framework');

var $ = require('jquery');

$(function () {

    function adjustBackground() {
        var $section = $('#section-middle');
        var $container = $section.find('.container');
        var $colText = $section.find('.col-text');
        var $colSlide = $section.find('.col-slide');
        var $background = $section.find('.background');

        var containerHeight = $container.outerHeight();
        var textHeight = $colText.outerHeight();
        var slideHeight = $colSlide.outerHeight();
        var backgroundHeight = containerHeight;

        if ($(window).width() >= 992) {
            if (textHeight < slideHeight) {
                var remainingHeight = containerHeight - textHeight;
                backgroundHeight = textHeight + (0.75 * remainingHeight);
            }
        } else {
            backgroundHeight = containerHeight - (slideHeight / 2);
        }

        $background.height(backgroundHeight);
    }
    var resizeId;
    $(window).on('resize', function () {
        clearTimeout(resizeId);
        resizeId = setTimeout(adjustBackground, 300);
    });
    setTimeout(adjustBackground, 300);
});

$(function () {

    $('.banner .owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        dots: false,
        mouseDrag: true,
        touchDrag: true,
        animateOut: 'fadeOut',
    });

    $('#section-middle .owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        mouseDrag: true,
        responsive: {
            0: {
                items: 1,
                dots: false,
                touchDrag: true,
            },
            576: {
                items: 3,
                dots: false,
                touchDrag: true,
            },
            992: {
                items: 3,
                dots: true,
                touchDrag: false,
            },
        },
    });
});

$(function () {

    var $navbar = $('#navbar');

    $navbar.find('.nav-item.dropdown').each(function () {
        var timeoutId;
        $(this)
            .on('mouseenter', function () {
                var $navItem = $(this);
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function () {
                    $navItem.addClass('show');
                    $navItem.children('.dropdown-menu').addClass('show');
                }, 200);
            })
            .on('mouseleave', function () {
                var $navItem = $(this);
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function () {
                    $navItem.removeClass('show');
                    $navItem.children('.dropdown-menu').removeClass('show');
                }, 200);
            })
        ;
    });

    $navbar.find('.dropdown-menu > li').each(function () {
        var timeoutId;
        $(this)
            .on('mouseenter', function () {
                var $navItem = $(this);
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function () {
                    $navItem.children('.dropdown-menu').addClass('show');
                }, 200);
            })
            .on('mouseleave', function () {
                var $navItem = $(this);
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function () {
                    $navItem.children('.dropdown-menu').removeClass('show');
                }, 200);
            })
        ;
    });
});

$(function () {

    var isOpen = false;
    var navbarMenu = new Mmenu('#navbar-menu', {
    });
    var api = navbarMenu.API;
    api.bind('open:finish', function () {
        isOpen = true;
    });
    api.bind('close:finish', function () {
        isOpen = false;
    });

    $('#navbar-menu-toggler').on('click', function () {
        if (isOpen) {
            navbarMenu.close();
        } else {
            navbarMenu.open();
        }
        isOpen = !isOpen;
    });
});
