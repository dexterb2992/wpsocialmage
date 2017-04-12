﻿// By : Codicode.com
// Source : http://www.codicode.com/art/image_color_up_$_plugin.aspx
// Licence : Creative Commons Attribution license (http://creativecommons.org/licenses/by/3.0/)
// You can use this plugin for commercial and personal projects.
// You can distribute, transform and use them into your work,
// but please always give credit to www.codicode.com
// The above copyright notice and this permission This notice shall be included in
// all copies or substantial portions of the Software.
(function($) {

    $.fn.colorUp = function() {
        function e(e) {
            return e.attr("speed") ? parseInt(e.attr("speed")) : 1e3
        }

        function t(e) {
            return e.attr("inverse") && e.attr("inverse") === "true" ? true : false
        }

        function n(e, t) {
            var n = document.createElement("canvas");
            var r = n.getContext("2d");
            n.width = e.width;
            n.height = e.height;
            r.drawImage(e, 0, 0);
            var i = r.getImageData(0, 0, n.width, n.height);
            for (var s = 0; s < i.height; s++) {
                for (var o = 0; o < i.width; o++) {
                    var u = s * 4 * i.width + o * 4;
                    switch (t) {
                        case "sepia":
                            var a = i.data[u] * .32 + i.data[u + 1] * .5 + i.data[u + 2] * .18;
                            i.data[u] = a + 50;
                            i.data[u + 1] = a;
                            i.data[u + 2] = a - 50;
                            break;
                        case "negative":
                            i.data[u] = 255 - i.data[u];
                            i.data[u + 1] = 255 - i.data[u + 1];
                            i.data[u + 2] = 255 - i.data[u + 2];
                            break;
                        case "light":
                            i.data[u] = i.data[u] + 80;
                            i.data[u + 1] = i.data[u + 1] + 80;
                            i.data[u + 2] = i.data[u + 2] + 80;
                            break;
                        case "dark":
                            i.data[u] = i.data[u] - 80;
                            i.data[u + 1] = i.data[u + 1] - 80;
                            i.data[u + 2] = i.data[u + 2] - 80;
                            break;
                        case "noise":
                            var f = (.5 - Math.random()) * 160;
                            i.data[u] = i.data[u] + f;
                            i.data[u + 1] = i.data[u + 1] + f;
                            i.data[u + 2] = i.data[u + 2] + f;
                            break;
                        default:
                            i.data[u] = i.data[u + 1] = i.data[u + 2] = i.data[u] * .32 + i.data[u + 1] * .5 + i.data[u + 2] * .18
                    }
                }
            }
            r.putImageData(i, 0, 0, 0, 0, i.width, i.height);
            return n.toDataURL()
        }
        $(window).load(function() {
            $(".colorup").each(function() {
                var r = $(this).wrap("<span />");
                var i = r.clone().css({
                    position: "absolute",
                    "z-index": "98",
                    opacity: "0"
                }).insertBefore(r);
                i.attr("src", n(this, r.attr("effect")));
                i.addClass("colorUpped").animate({
                    opacity: t(r) ? 1 : 0
                }, e(r))
            });
            $(".colorUpped").mouseover(function() {
                $(this).stop().animate({
                    opacity: t($(this)) ? 0 : 1
                }, e($(this)))
            });
            $(".colorUpped").mouseout(function() {
                $(this).stop().animate({
                    opacity: t($(this)) ? 1 : 0
                }, e($(this)))
            })
        })
    };
    $.fn.colorUp();

}(jQuery));