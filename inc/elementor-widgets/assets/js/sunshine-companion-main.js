/**
 * Sunshine Companion widgets, front end, without jQuery: carousels, the
 * portfolio menu's active button, scroll-to-top, counters, the Mailchimp
 * field map and the wedding countdown. Carousels, scroll-to-top and the
 * countdown come from the theme's ColorlibUI (drop-in Owl Carousel, ScrollUp
 * and Final Countdown with the same options and markup).
 */
(function () {
    'use strict';

    function run() {
        var UI = window.ColorlibUI;
        if (!UI) return;

        UI.owl('.hero-slides', {
            items: 1,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 0,
            dots: false,
            nav: true,
            navText: ['<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>', '<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>']
        });

        UI.owl('.sunshine-service-slides', {
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 30,
            center: true,
            dots: false,
            nav: true,
            startPosition: 1,
            navText: ['<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>', '<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });

        UI.owl('.sunshine-workflow-slides', {
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 30,
            center: true,
            dots: true,
            startPosition: 1,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });

        UI.owl('.sunshine-team-slides', {
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 800,
            margin: 50,
            center: true,
            nav: true,
            navText: ['<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>', '<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });

        UI.owl('.testimonials-slides', {
            items: 3,
            loop: true,
            autoplay: true,
            smartSpeed: 1500,
            margin: 0,
            center: true,
            nav: true,
            navText: ['<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>', '<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });

        // The old script also started Barfiller on .bar and Isotope (after
        // imagesLoaded) on .sunshine-portfolio, but only when those jQuery
        // plugins were present, and neither the plugin nor the theme loaded
        // them, so that code never ran. It is left out.

        UI.toElements('.portfolio-menu button.btn').forEach(function (button) {
            button.addEventListener('click', function () {
                UI.toElements('.portfolio-menu button.btn').forEach(function (b) {
                    b.classList.remove('active');
                });
                button.classList.add('active');
            });
        });

        UI.scrollUp({
            scrollSpeed: 1500,
            scrollText: '<i class="fa-solid fa-angle-up"></i>'
        });

        UI.counter('.counter', { time: 2000 });

        // Background video: the old script called the jQuery YTPlayer plugin
        // on [data-videoid], but that plugin was never loaded, so it threw on
        // any page with such an element. No widget prints one; left out.

        // MC Scripts
        if (document.querySelector('.sunshine-subscribe-newsletter-area')) {
            window.fnames = new Array();
            window.ftypes = new Array();
            fnames[0] = 'EMAIL';
            ftypes[0] = 'email';
            fnames[1] = 'FNAME';
            ftypes[1] = 'text';
            fnames[2] = 'LNAME';
            ftypes[2] = 'text';
            fnames[3] = 'ADDRESS';
            ftypes[3] = 'address';
            fnames[4] = 'PHONE';
            ftypes[4] = 'phone';
            fnames[5] = 'BIRTHDAY';
            ftypes[5] = 'birthday';
        }

        var clock = document.getElementById('clock');
        if (clock) {
            var eventTime = clock.getAttribute('data-event-time');
            UI.countdown(clock, eventTime, function (event) {
                clock.innerHTML = event.strftime(
                    '<div class="countdown_wrap d-flex"><div  class="single_countdown"><h3>%D</h3><span>Days</span></div><div class="single_countdown"><h3>%H</h3><span>Hours</span></div><div class="single_countdown"><h3>%M</h3><span>Minutes</span></div><div class="single_countdown"><h3>%S</h3><span>Seconds</span></div></div>'
                );
            });
        }
    }

    // This script used to run as soon as it loaded, before DOM ready, so its
    // scrollUp call came before the theme's (made on DOM ready) and won: the
    // plugin keeps the first one. 'interactive' is reached just before
    // DOMContentLoaded, which keeps that order.
    if (document.readyState === 'loading') {
        document.addEventListener('readystatechange', function start() {
            document.removeEventListener('readystatechange', start);
            run();
        });
    } else {
        run();
    }
}());
