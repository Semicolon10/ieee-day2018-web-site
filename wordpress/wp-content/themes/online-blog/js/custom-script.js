(function (e) {
    "use strict";
    var n = window.Thememattic_JS || {};
    var iScrollPos = 0;
    var loadType, loadButton, loader, pageNo, loading, morePost, scrollHandling;

    n.stickyMenu = function () {
        e(window).scrollTop() > 350 ? e("#masthead").addClass("nav-affix") : e("#masthead").removeClass("nav-affix")
    },
        n.mobileMenu = {
            init: function () {
                this.toggleMenu(), this.menuMobile(), this.menuArrow(), this.offcanvasNav(), this.submenuHover()
            },
            toggleMenu: function () {
                e('#masthead').on('click', '.toggle-menu', function (event) {
                    var ethis = e('.main-navigation .menu .menu-mobile');
                    if (ethis.css('display') == 'block') {
                        ethis.slideUp('300');
                    } else {
                        ethis.slideDown('300');
                    }
                    e('.ham').toggleClass('exit');
                });
                e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                    event.preventDefault();
                    var ethis = e(this),
                        eparent = ethis.closest('li'),
                        esub_menu = eparent.find('> .sub-menu');
                    if (esub_menu.css('display') == 'none') {
                        esub_menu.slideDown('300');
                        ethis.addClass('active');
                    } else {
                        esub_menu.slideUp('300');
                        ethis.removeClass('active');
                    }
                    return false;
                });
            },
            menuMobile: function () {
                if (e('.main-navigation .menu > ul').length) {
                    var ethis = e('.main-navigation .menu > ul'),
                        eparent = ethis.closest('.main-navigation'),
                        pointbreak = eparent.data('epointbreak'),
                        window_width = window.innerWidth;
                    if (typeof pointbreak == 'undefined') {
                        pointbreak = 991;
                    }
                    if (pointbreak >= window_width) {
                        ethis.addClass('menu-mobile').removeClass('menu-desktop');
                        e('.main-navigation .toggle-menu').css('display', 'block');
                    } else {
                        ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                        e('.main-navigation .toggle-menu').css('display', '');
                    }
                }
            },

            menuArrow: function () {
                if (e('#masthead .main-navigation div.menu > ul').length) {
                    e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="icon-arrow-down icons">');
                }
            },

            offcanvasNav: function () {
                e('#widgets-nav').sidr({
                    name: 'sidr-nav',
                    side: 'left'
                });

                e('.sidr-class-sidr-button-close').click(function () {
                    e.sidr('close', 'sidr-nav');
                });
            },

            submenuHover: function () {
                e('.site-header .main-navigation li.mega-menu .sub-cat-list li').on('hover', function () {
                    if ( ! e( this ).hasClass( 'current' ) ) {
                        var eposts = e( this ).parents( '.sub-cat-list' ).first().siblings( '.sub-cat-posts' ).first();
                        e( this ).siblings( '.current' ).removeClass( 'current' ).end().addClass( 'current' );
                        eposts.children( '.current' ).removeClass( 'current' );
                        eposts.children( '.' + $( this ).attr( 'data-id' ) ).addClass( 'current' );
                    }
                } )
            }
        },

        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {

                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.SlickCarousel = function () {
            e(".main-slider-1").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: true,
                nextArrow: '<i class="slide-icon slide-next icon-arrow-right icons"></i>',
                prevArrow: '<i class="slide-icon slide-prev icon-arrow-left icons"></i>',
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            arrows: false
                        }
                    }
                ]
            });

            e(".main-slider-2").slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                centerMode: true,
                centerPadding: '55px',
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-next icon-arrow-right icons"></i>',
                prevArrow: '<i class="slide-icon slide-prev icon-arrow-left icons"></i>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            centerMode: false
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            arrows: false,
                            centerMode: false
                        }
                    }
                ]
            });

            e(".gallery-columns-1").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: false,
                nextArrow: '<i class="slide-icon slide-next icon-arrow-right icons"></i>',
                prevArrow: '<i class="slide-icon slide-prev icon-arrow-left icons"></i>',
            });
        },


        n.Thememattic_preloader = function () {
            e(window).load(function () {
                e("body").addClass("page-loaded");
            });
        },

        n.Thememattic_slideheight = function () {
                e('.main-slider-2 .slick-slide').matchHeight({
                    byRow: true,
                    property: 'min-height',
                });
        },

        n.ThemematticReveal = function () {
            e('.icon-search').on('click', function (event) {
                e('body').toggleClass('reveal-search');
            });
            e('.close-popup').on('click', function (event) {
                e('body').removeClass('reveal-search');
            });
        },

        n.Thememattic_wow = function () {
            if (e('.wow').length) {
                var wow = new WOW(
                    {
                        animateClass: 'animated',
                        offset: 0,
                    }
                );
                wow.init();
            }
        },

        n.MagnificPopup = function () {
            e('.gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });
        },

        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        },
        n.thememattic_matchheight = function () {
            jQuery('.theiaStickySidebar', 'body').parent().theiaStickySidebar({
                additionalMarginTop: 30
            });
        },
        n.nav_tab = function () {
            e('.tab-trigger').on('click', function () {
                e([e(this).parent()[0], e(e(this).data('href'))[0]]).addClass('active').siblings('.active').removeClass('active');
            });
        },

        n.setLoadPostDefaults = function () {
            if (e('.load-more-posts').length > 0) {
                loadButton = e('.load-more-posts');
                loader = e('.load-more-posts .ajax-loader');
                loadType = loadButton.attr('data-load-type');
                pageNo = 2;
                loading = false;
                morePost = true;
                scrollHandling = {
                    allow: true,
                    reallow: function () {
                        scrollHandling.allow = true;
                    },
                    delay: 400
                };
            }
        },

        n.fetchPostsOnScroll = function () {
            if (e('.load-more-posts').length > 0 && 'scroll' === loadType) {
                var iCurScrollPos = e(window).scrollTop();
                if (iCurScrollPos > iScrollPos) {
                    if (!loading && scrollHandling.allow && morePost) {
                        scrollHandling.allow = false;
                        setTimeout(scrollHandling.reallow, scrollHandling.delay);
                        var offset = e(loadButton).offset().top - e(window).scrollTop();
                        if (2000 > offset) {
                            loading = true;
                            n.ShowPostsAjax(loadType);
                        }
                    }
                }
                iScrollPos = iCurScrollPos;
            }
        },

        n.fetchPostsOnClick = function () {
            if (e('.load-more-posts').length > 0 && 'click' === loadType) {
                e('.load-more-posts a').on('click', function (event) {
                    event.preventDefault();
                    n.ShowPostsAjax(loadType);
                });
            }
        },

        n.ShowPostsAjax = function (loadType) {
            e.ajax({
                type: 'GET',
                url: onlineVal.ajaxurl,
                data: {
                    action: 'online_blog_load_more',
                    nonce: onlineVal.nonce,
                    page: pageNo,
                    post_type: onlineVal.post_type,
                    search: onlineVal.search,
                    cat: onlineVal.cat,
                    taxonomy: onlineVal.taxonomy,
                    author: onlineVal.author,
                    year: onlineVal.year,
                    month: onlineVal.month,
                    day: onlineVal.day
                },
                dataType: 'json',
                beforeSend: function () {
                    loader.addClass('ajax-loader-enabled');
                },
                success: function (response) {
                    loader.removeClass('ajax-loader-enabled');
                    if (response.success) {
                        e('.online-posts-lists').append(response.data.content);

                        pageNo++;
                        loading = false;
                        if (!response.data.more_post) {
                            morePost = false;
                            loadButton.fadeOut();
                        }
                    } else {
                        loadButton.fadeOut();
                    }
                }
            });
        },

        e(document).ready(function () {
            n.mobileMenu.init(), n.DataBackground(), n.SlickCarousel(), n.Thememattic_preloader(), n.Thememattic_slideheight(), n.ThemematticReveal(), n.Thememattic_wow(), n.MagnificPopup(), n.scroll_up(), n.thememattic_matchheight(), n.nav_tab(), n.setLoadPostDefaults(), n.fetchPostsOnClick();
        }),
        e(window).scroll(function () {
            n.stickyMenu(), n.show_hide_scroll_top(), n.fetchPostsOnScroll();
        }),
        e(window).resize(function () {
            n.mobileMenu.menuMobile();
        })
})(jQuery);

