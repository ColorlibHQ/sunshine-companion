/**
 * Portfolio "Load more" button (.loadAjax): fetches the next portfolio items
 * over admin-ajax into .sunshine-portfolio-load and lays the Isotope grid out
 * again. Settings come from the portfolioloadajax object. No jQuery.
 */
(function () {
    'use strict';

    // $.ajax sent nested data the way PHP reads arrays (elsettings[0][img][url]=…).
    function flatten(value, prefix, out) {
        if (value !== null && typeof value === 'object') {
            Object.keys(value).forEach(function (key) {
                flatten(value[key], prefix ? prefix + '[' + key + ']' : key, out);
            });
        } else {
            out[prefix] = value == null ? '' : value;
        }
        return out;
    }

    function run() {
        var UI = window.ColorlibUI;
        var portfolioloadajax = window.portfolioloadajax;

        //  Portfolio load more button Ajax
        var loadbuttons = document.querySelectorAll('.loadAjax');
        if (!UI || !portfolioloadajax || !loadbuttons.length) return;

        var postNumber = portfolioloadajax.postNumber,
            Incr = 0;

        Array.prototype.forEach.call(loadbuttons, function (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                Incr = Incr + parseInt(postNumber);

                var data = {
                    'action': 'sunshine_portfolio_ajax',
                    'postNumber': postNumber,
                    'postIncrNumber': Incr,
                    'elsettings': portfolioloadajax.elsettings
                };

                UI.request(portfolioloadajax.action_url, {
                    method: 'POST',
                    data: flatten(data, '', {})
                }).then(function (html) {
                    UI.toElements('.sunshine-portfolio-load').forEach(function (el) {
                        el.innerHTML = html;
                    });

                    UI.isotope('.sunshine-portfolio', 'reloadItems');
                    UI.isotope('.sunshine-portfolio', {
                        itemSelector: '.single_gallery_item',
                        percentPosition: true,
                        masonry: {
                            columnWidth: '.single_gallery_item'
                        }
                    });

                    var loaditems = parseInt(Incr) + parseInt(postNumber);

                    if (portfolioloadajax.totalitems == loaditems) {
                        button.style.display = 'none';
                    }
                });
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', run);
    } else {
        run();
    }
}());
