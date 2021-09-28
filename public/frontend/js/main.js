jQuery(document).ready(function($) {

    $(window).on("scroll", function() {

        var hb = $('header').height();

        if ($(this).scrollTop() > hb) {

            $('header').addClass('active');

        } else {

            $('header').removeClass('active');

        }



        if ($(this).scrollTop() > 0) {

            $('.back-to-top').addClass('active');

        } else {

            $('.back-to-top').removeClass('active');

        }

    });



    $('.back-to-top').click(function() {

        $('html, body').animate({ scrollTop: 0 }, 400);

    });



    // $('.megamenu-desktop .megamenu-content > .item-sub')

    //     .mouseenter(function() {

    //         $(this).children().addClass('active');

    //         $(this).children().next().slideToggle('slow');

    //     })

    //     .mouseleave(function() {

    //         $(this).children().removeClass('active');

    //         $(this).children().next().slideToggle('slow');

    // });



    // $('.megamenu-desktop .megamenu-content .sub-menu .item-sub')

    //     .mouseenter(function() {

    //         $(this).children().addClass('active');

    //         $(this).children().next().slideToggle('slow');

    //     })

    //     .mouseleave(function() {

    //         $(this).children().removeClass('active');

    //         $(this).children().next().slideToggle('slow');

    // });



    $('.mobile-content .item-sub > a').click(function(e) {

        e.preventDefault();

        $(this).next().slideToggle('slow');

        $(this).parent().toggleClass('active');

    });

    $('.mobile-content .sub-menu').click(function() {

        $(this).prev().removeClass('active');

        $(this).slideToggle('slow');

    });

    $('.mobile-content .sub-menu .sub-content').click(function(e) {

        e.stopPropagation();

    });



    $(window).resize(function() {

        var w_window = $(window).width();

        if (w_window >= 992) {

            $('.menu-box').height('100%');

        }

    });

});



jQuery(document).ready(function($) {

    $(".slick-slidershow").slick({

        dots: true,

        infinite: true,

        speed: 500,

        slidesToShow: 1,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '',

        nextArrow: '',

        responsive: [

            {

                breakpoint: 1200,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 992,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 768,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 576,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    $(".slick-testimonials").slick({

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 1,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"></button>',

        nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"></button>',

        responsive: [

            {

                breakpoint: 1200,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 992,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 768,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 576,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    $(".slick-brands").slick({

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 6,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"><i class="far fa-angle-left icon"></i></button>',

        nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"><i class="far fa-angle-right icon"></i></button>',

        responsive: [

            {

                breakpoint: 1200,

                settings: {

                    slidesToShow: 5,

                }

            },

            {

                breakpoint: 992,

                settings: {

                    slidesToShow: 4,

                }

            },

            {

                breakpoint: 768,

                settings: {

                    slidesToShow: 3,

                }

            },

            {

                breakpoint: 576,

                settings: {

                    slidesToShow: 2,

                }

            }

        ]

    });



    $(".slick-products").slick({

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 4,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"><i class="far fa-angle-left icon"></i></button>',

        nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"><i class="far fa-angle-right icon"></i></button>',

        responsive: [

            {

                breakpoint: 1200,

                settings: {

                    slidesToShow: 3,

                }

            },

            {

                breakpoint: 992,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 768,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 576,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    $(".slick-products-related").slick({

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 5,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"><i class="far fa-angle-left icon"></i></button>',

        nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"><i class="far fa-angle-right icon"></i></button>',

        responsive: [

            {

                breakpoint: 1200,

                settings: {

                    slidesToShow: 4,

                }

            },

            {

                breakpoint: 992,

                settings: {

                    slidesToShow: 3,

                }

            },

            {

                breakpoint: 768,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 576,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    $('.slick-products-for').slick({

        slidesToShow: 1,

        slidesToScroll: 1,

        arrows: false,

        fade: true,

        asNavFor: '.slick-products-nav'

    });

    $('.slick-products-nav').slick({

        slidesToShow: 3,

        slidesToScroll: 1,

        asNavFor: '.slick-products-for',

        dots: false,

        // centerMode: true,

        // variableWidth: true,

        focusOnSelect: true,

        prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"><i class="far fa-angle-left icon"></i></button>',

        nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"><i class="far fa-angle-right icon"></i></button>',

    });



    $(".slick-blogs").slick({

        dots: true,

        infinite: true,

        speed: 500,

        slidesToShow: 3,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '',

        nextArrow: '',

        responsive: [

            {

                breakpoint: 1200,

                settings: {

                    slidesToShow: 3,

                }

            },

            {

                breakpoint: 992,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 768,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 576,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });



    $(".slick-blogs-related").slick({

        dots: false,

        infinite: true,

        speed: 500,

        slidesToShow: 3,

        slidesToScroll: 1,

        adaptiveHeight: true,

        prevArrow: '',

        nextArrow: '',

        responsive: [

            {

                breakpoint: 1200,

                settings: {

                    slidesToShow: 3,

                }

            },

            {

                breakpoint: 992,

                settings: {

                    slidesToShow: 2,

                }

            },

            {

                breakpoint: 768,

                settings: {

                    slidesToShow: 1,

                }

            },

            {

                breakpoint: 576,

                settings: {

                    slidesToShow: 1,

                }

            }

        ]

    });

});



jQuery(document).ready(function($) {

    // popups

    $('.btn-popup').click(function(e) {

        e.preventDefault();

        var pop_odr = $(this).hasClass('btn-popup-order');



        if (pop_odr) {

            $('.art-popups-oder').addClass('active');

        }

        var pop_agency = $(this).hasClass('btn-popup-agency');

        if (pop_agency) {

            $('.art-popups-agency').addClass('active');

        }

    });

    ////////////////////

    var hg_pop = $('.art-popups .popups-box').height();

    var hg_win = $(window).height();

    if (hg_pop > hg_win) {

        $('.art-popups .popups-box').css({ 'top': '10px' });

        $('.art-popups .popups-box').height(hg_win - 20);

    } else {

        $('.art-popups .popups-box').css({ 'top': 'auto' });

        $('.art-popups .popups-box').height('auto');

    }

    ////////////////////

    $('.art-popups .popups-box').click(function() {

        $(this).parent().removeClass('active');

    });

    ////////////////////

    $('.art-popups .popups-content').click(function(e) {

        e.stopPropagation();

    });

    // end popups



    $(window).resize(function() {

        // popups

        var hg_pop = $('.art-popups .popups-box').height();

        var hg_win = $(window).height();

        if (hg_pop > hg_win) {

            $('.art-popups .popups-box').css({ 'top': '10px' });

            $('.art-popups .popups-box').height(hg_win - 20);

        } else {

            $('.art-popups .popups-box').css({ 'top': 'auto' });

            $('.art-popups .popups-box').height('auto');

        }

        // end popups

    });

});



jQuery(document).ready(function($) {

    $('.content-sidebar-sub').hide();

    $('.sidebar-sub.active .content-sidebar-sub').show();

    $('.title-sidebar-sub').click(function() {

        var clac = $(this).parent().hasClass('active');

        if (!clac) {

            $('.sidebar-sub').removeClass('active');

            $(this).parent().addClass('active');

            $('.content-sidebar-sub').hide();

            $(this).next().slideDown('slow');

        } else {

            $(this).parent().removeClass('active');

            $(this).next().slideUp('slow');

        }

    });



    $('.product-description-content .title').click(function() {

        var clac = $(this).hasClass('active');



        if (!clac) {

            $('.product-description-content .title').removeClass('active');

            $(this).addClass('active');

            $('.product-description-content .content').hide();

            $(this).next().slideDown('slow');

        } else {

            $(this).removeClass('active');

            $(this).next().slideUp('slow');

        }

    });



    var wh_win = $(window).width();

    if (wh_win > 991) {

        $('.content-sidebar-sub').hide();

        $('.sidebar-sub:first-child').addClass('active');

        $('.sidebar-sub:first-child .content-sidebar-sub').show();

    } else {

        $('.content-sidebar-sub').hide();

        $('.sidebar-sub').removeClass('active');

    }



    $('.quotes-content .form-group-select .item').click(function() {

        var trit = $(this).text();

        $('.quotes-content .form-group-select .form-control').val(trit);

        $('.quotes-content .form-group-select .sub-content').hide();

    });

    $('.quotes-content .form-group-select .sub-title').click(function() {

        $(this).next().slideToggle('slow');

    });



    $('.about-us-site .banner-tab-content .content').hide();

    $('.about-us-site .banner-tab-content.active .content').show();

    $('.about-us-site .banner-content h4').click(function() {

        var hsac = $(this).parent().hasClass('active');

        if (!hsac) {

            $('.about-us-site .banner-tab-content').removeClass('active');

            $(this).parent().addClass('active');

            $('.about-us-site .banner-tab-content .content').slideUp('slow');

            $(this).next().slideToggle('slow');

        }

    });



    $('.view-mode-box > a').click(function(e) {

        e.preventDefault();

        var ac = $(this).hasClass('active');

        if (!ac) {

            var vlw = $(this).hasClass('view-list');

            if (vlw) {
                $('.shop-content').addClass('shop-content-list');
            } else {
                $('.shop-content').removeClass('shop-content-list');
            }

            $('.view-mode-box > a').removeClass('active');
            $(this).addClass('active');

        }

    });



    $(window).resize(function() {

        var wh_win = $(window).width();

        if (wh_win > 991) {

            $('.content-sidebar-sub').hide();

            $('.sidebar-sub:first-child').addClass('active');

            $('.sidebar-sub:first-child .content-sidebar-sub').show();

        } else {

            $('.content-sidebar-sub').hide();

            $('.sidebar-sub').removeClass('active');

        }

    });

});



// 28/01/2021

jQuery(document).ready(function($) {

    $(".slick-products-blogs-related").slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 1,
        adaptiveHeight: true,
        prevArrow: '<button class="slick-arrow slick-prev" href="javascript:0"><i class="far fa-angle-left icon"></i></button>',
        nextArrow: '<button class="slick-arrow slick-next" href="javascript:0"><i class="far fa-angle-right icon"></i></button>',
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    setTimeout(function() {
        var hght = $('.header-top').outerHeight();
        var hghdsck = $('.header-stick').outerHeight();
        if (hght) {
            hb = parseInt(hght) + parseInt(hghdsck);
            $('.headers').outerHeight(hb);
        } else {
            $('.headers').outerHeight(hghdsck);
        }

        $(window).resize(function() {
            var hght = $('.header-top').outerHeight();
            var hghdsck = $('.header-stick').outerHeight();
            if (hght) {
                hb = parseInt(hght) + parseInt(hghdsck);
                $('.headers').outerHeight(hb);
            } else {
                $('.headers').outerHeight(hghdsck);
            }
        });

        var hegw = $(window).outerHeight();
        $('.menu-content').outerHeight(hegw);
    }, 400);

    $('.search-box-title .btn').click(function() {
        var hs = $('.search-box').hasClass('active');
        var hg = $(window).height();

        if (!hs) {
            $('.search-box').addClass('active');
            $('.search-box').append('<div class="bg-popup" style="height: ' + hg + 'px"></div>');
        }
    });

    $(document).on('click', '.bg-popup', function() {
        $('.search-box').removeClass('active');
        $('.bg-popup').remove();
    });

    $('.user-box:not(.user-login) .user-box-title .btn').click(function(e) {
        e.preventDefault();
    });

    $('.popups-title-regis .btn').click(function(e) {
        e.preventDefault();

        $('.art-popups-agency').addClass('active');
    });

    $('.btn-them-thu .btn-xem-them').click(function() {
        $('.btn-them-thu').addClass('active');
    });

    $('.btn-them-thu .btn-thu-gon').click(function() {
        $('.btn-them-thu').removeClass('active');

        var clbl = $(this).hasClass('thu-gon-blog');

        var hght = $('.headers').outerHeight();
        var hgh = $('.product-details-box').outerHeight();
        var hbr = $('.breadcrumbs-content').outerHeight();
        var hgsb = $('.att-sidebars').outerHeight();

        var wd = $(window).width();

        if (wd >= 992 || clbl) {
            if (clbl) {
                var hgh = $('.blog-details-box').outerHeight();
                var hb = parseInt(hgh) + parseInt(hght) + parseInt(hbr) - 300;
            } else {
                var hb = parseInt(hgh) + parseInt(hght) + parseInt(hbr);
            }

        } else {
            // alert(clbl);
            var hb = parseInt(hgh) + parseInt(hght) + parseInt(hbr) + parseInt(hgsb);
        }

        $('html, body').animate({ scrollTop: hb }, 0);
    });

    var wdhg = $(window).outerHeight();
    $('.page-thanks-site .banners-box').height(wdhg);

    var wdbhg = $('.page-thanks-site .banners-content').outerHeight();
    if (wdbhg >= wdhg) {
        $('.page-thanks-site .banners-box').height('auto');
        $('.page-thanks-site .banners-box').css({ 'padding': '30px 0', 'display': 'block' });
    }

    $(window).resize(function() {
        var wdhg = $(window).outerHeight();
        $('.page-thanks-site .banners-box').height(wdhg);

        var wdbhg = $('.page-thanks-site .banners-content').outerHeight();
        if (wdbhg >= wdhg) {
            $('.page-thanks-site .banners-box').height('auto');
            $('.page-thanks-site .banners-box').css({ 'padding': '30px 0', 'display': 'block' });
        }
    });

    $('.popups-title-dang-ky').click(function(e) {
        e.preventDefault();

        $('.art-popups-dang-ky').addClass('active');
        $('.art-popups-dang-nhap').removeClass('active');
    });

    $('.popups-title-dang-nhap').click(function(e) {
        e.preventDefault();

        $('.art-popups-dang-nhap').addClass('active');
        $('.art-popups-quen-pass').removeClass('active');
        $('.art-popups-dang-ky').removeClass('active');
    });

    $('.popups-title-quen-pass').click(function(e) {
        e.preventDefault();

        $('.art-popups-quen-pass').addClass('active');
        $('.art-popups-dang-nhap').removeClass('active');
    });

    $('.art-popups').click(function() {
        $(this).removeClass('active');
    });

    $('.popups-box .popups-content').click(function(e) {
        e.stopPropagation();
    });
});

// nguyen huu thanh
$(document).ready(function() {
    function showControl() {
        $(".btn__show").click(function() {
            $(".itemSidebar").toggleClass("active");
        });
    }
    showControl();
    $(function() {
        $(".datepicker")
            .datepicker({
                autoclose: true,
                todayHighlight: true,
                language: "vn",
            })
            .datepicker("update", new Date());
    });


});