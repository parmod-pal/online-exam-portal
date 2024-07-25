(function(e) {
    "use strict";
    var teslaThemes = {
        init: function() {
            this.module()
        },
        module: function() {
            this.queryLoader();
            this.sticky();
            this.viewport();
            this.flickr();
            this.menu();
            this.knob();
            this.fitvids();
            this.progressBar();
            this.tubular();
            this.zoomImage();
            this.datePicker();
            this.roomSelect();
            this.parallaxEff();
            this.customScroll()
        },
        queryLoader: function() {
            jQuery(document).ready(function() {
                function e() {
                    jQuery("#home").addClass("show-content");
                    teslaThemes.simpleSlider()
                }
                jQuery("body").queryLoader2({
                    backgroundColor: "#FBFBFB",
                    barColor: "#E48D40",
                    percentage: false,
                    barHeight: 10,
                    minimumTime: 3e3,
                    overlayId: "theme-loader",
                    onComplete: e()
                })
            })
        },
        sticky: function() {
            if (jQuery(".sticky-bar").length) {
                jQuery(".sticky-bar").sticky({
                    topSpacing: 0
                })
            }
        },
        fitvids: function() {
            var e = jQuery("noscript").text();
            if (e.trim().search("iframe") === 1) {
                jQuery("noscript").parent().append(e)
            }
            jQuery("#home").fitVids({
                customSelector: "iframe[src^='//player.vimeo.com'], iframe[src^='//www.youtube.com']"
            })
        },
        viewport: function() {
            jQuery(window).scroll(function() {
                jQuery(".small-footer:in-viewport").each(function() {})
            })
        },
        parallaxEff: function() {
            jQuery(window).stellar()
        },
        tubular: function() {
            if (jQuery(".full-video").length) {
                jQuery(".full-video").tubular({
                    videoId: "ssutK1Gei4A",
                    start: 3
                })
            }
        },
        flickr: function() {
            jQuery(".flickr-widget").each(function() {
                var e = jQuery(this),
                    t = e.attr("data-userid"),
                    n = parseInt(e.attr("data-items"));
                $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?lang=en-us&format=json&id=" + t + "&jsoncallback=?", function(t) {
                    for (var r = 0; r < n && r < t.items.length; r++) {
                        var i = function() {
                            if (t.items[r].media.m) {
                                var n = jQuery("<a>").addClass("flickr-link").attr("href", t.items[r].link).attr("target", "_blank");
                                var i = jQuery("<img>").addClass("flickr-img").attr("src", t.items[r].media.m).attr("alt", "").each(function() {
                                    var e = this;
                                    var t = jQuery(this);
                                    var r = function() {
                                        n.append(e)
                                    };
                                    var i = false;
                                    var s = function() {
                                        if (!i) {
                                            i = true;
                                            r()
                                        }
                                    };
                                    var o = function() {
                                        if (e.complete && t.height() !== 0) s()
                                    };
                                    o();
                                    jQuery(this).load(function() {
                                        s()
                                    })
                                });
                                e.append(jQuery('<li class="col-xs-3 col-sm-4 col-md-4">').append(n))
                            }
                        };
                        i()
                    }
                })
            })
        },
        twitter: function() {
            var e = function(e) {
                e = e.replace(/(https?:\/\/\S+)/gi, function(e) {
                    return '<a href="' + e + '">' + e + "</a>"
                });
                e = e.replace(/(^|)@(\w+)/gi, function(e) {
                    return '<a href="http://twitter.com/' + e + '">' + e + "</a>"
                });
                e = e.replace(/(^|)#(\w+)/gi, function(e) {
                    return '<a href="http://search.twitter.com/search?q=' + e.replace(/#/, "%23") + '">' + e + "</a>"
                });
                return e
            };
            jQuery(".twitter-widget").each(function() {
                var t = jQuery(this);
                var n = new Date;
                var r = "Loading tweets..";
                var i = t.append("<p>" + r + "</p>");
                t.append(i);
                var s = t.attr("data-user");
                var o = parseInt(t.attr("data-posts"), 10);
                $.getJSON("php/twitter423c.html?user=" + s, function(t) {
                    i.empty();
                    for (var r = 0; r < o && r < t.length; r++) {
                        var s = Math.floor((n.getTime() - Date.parse(t[r].created_at)) / 1e3);
                        var u;
                        var a = s % 60;
                        s = Math.floor(s / 60);
                        var f = s % 60;
                        if (f) {
                            s = Math.floor(s / 60);
                            var l = s % 60;
                            if (l) {
                                s = Math.floor(s / 60);
                                var c = s % 24;
                                if (c) {
                                    s = Math.floor(s / 24);
                                    var h = s % 7;
                                    if (h) u = h + " week" + (1 == h ? "" : "s") + " ago";
                                    else u = c + " day" + (1 == c ? "" : "s") + " ago"
                                } else u = l + " hour" + (1 == l ? "" : "s") + " ago"
                            } else u = f + " minute" + (1 == f ? "" : "s") + " ago"
                        } else u = a + " second" + (1 == a ? "" : "s") + " ago";
                        var p = "<p>" + e(t[r].text) + "<span>" + u + "</span>" + "</p>";
                        i.append(p)
                    }
                })
            })
        },
        menu: function() {
            var e = jQuery(".main-nav"),
                t = jQuery(".mobile-switch"),
                n;
            if (jQuery(window).width() < 992) {
                e.addClass("mobile-menu")
            }
            jQuery(window).resize(function(t) {
                if (t.target.innerWidth < 992) {
                    e.addClass("mobile-menu")
                } else {
                    e.removeClass("mobile-menu");
                    jQuery("body").removeClass("acitve-mobile")
                }
            });
            n = jQuery(".mobile-menu");
            t.click(function(e) {
                e.preventDefault();
                jQuery("body").toggleClass("acitve-mobile")
            })
        },
        simpleSlider: function() {
            jQuery(".simple-slider").sudoSlider({
                numeric: false,
                controlsShow: false,
                responsive: true,
                autoHeight: false,
                effect: "random",
                customLink: ".custom-controls a",
                continuous: true,
                updateBefore: true,
				auto:true,
                animationZIndex: 10
            });
            jQuery(".slider-helper").sudoSlider({
                numeric: false,
                controlsShow: false,
                responsive: true,
                autoHeight: false,
                effect: "fadeOutIn",
                customLink: ".custom-controls a",
                continuous: true,
				auto:true,
				speed:1000,
                updateBefore: true,
                animationZIndex: 10
            });
            var e = jQuery("#rooms-slider").sudoSlider({
                numeric: false,
                controlsShow: false,
                responsive: true,
                slideCount: 3,
                moveCount: 1,
                speed: 500,
                continuous: true,
                updateBefore: true,
                customLink: "#controls-carousel a"
            });
            if (jQuery("#rooms-slider").length) {
                if (jQuery(window).width() < 990 && jQuery(window).width() > 768) {
                    e.setOption("slideCount", 2)
                } else if (jQuery(window).width() < 768) {
                    e.setOption("slideCount", 1)
                } else {
                    e.setOption("slideCount", 3)
                }
                jQuery(window).resize(function() {
                    if (jQuery(window).width() < 990 && jQuery(window).width() > 768) {
                        e.setOption("slideCount", 2)
                    } else if (jQuery(window).width() < 768) {
                        e.setOption("slideCount", 1)
                    } else {
                        e.setOption("slideCount", 3)
                    }
                })
            }
            var t = jQuery(".preview-room-nav").sudoSlider({
                numeric: false,
                controlsShow: false,
                responsive: true,
                slideCount: 8,
                moveCount: 1,
                speed: 500,
                continuous: true,
                updateBefore: true,
                customLink: ".preview-room-nav b"
            });
            if (jQuery("#portfolio-slider").length) {
                jQuery(window).resize(function() {
                    if (jQuery(window).width() < 992) {
                        t.setOption("slideCount", 1)
                    } else {
                        t.setOption("slideCount", 3)
                    }
                })
            }
            jQuery("#review-slider").sudoSlider({
                numeric: false,
                controlsShow: false,
                responsive: true,
                slideCount: 1,
                moveCount: 1,
                speed: 500,
                continuous: true,
                updateBefore: true,
                customLink: ".review-nav"
            });
            jQuery(".preview-room").sudoSlider({
                numeric: false,
                controlsShow: false,
                responsive: true,
                autoHeight: false,
                effect: "fadeOutIn",
                customLink: ".preview-room-nav a",
                continuous: true,
                updateBefore: true,
                animationZIndex: 10
            });
            jQuery("#testimonials-slider").sudoSlider({
                numeric: false,
                responsive: true,
                moveCount: 1,
                speed: 1e3,
                updateBefore: true,
                vertical: true,
                continuous: true,
                auto: true,
                prevhtml: ' <a href="#" class="prev-nav"><i class="icon-503"></i></a> ',
                nexthtml: ' <a href="#" class="next-nav"><i class="icon-515"></i></a> ',
                controlsattr: 'id="controls-testimonials"'
            });
            jQuery(".booking-slider").sudoSlider({
                numeric: false,
                controlsShow: false,
                responsive: true,
                slideCount: 1,
                moveCount: 1,
                speed: 500,
                continuous: false,
                updateBefore: true,
                customLink: ".nav-step"
            });
            jQuery(".portfolio-slider").sudoSlider({
                numeric: false,
                responsive: true,
                moveCount: 1,
                speed: 1e3,
                auto: false,
                continuous: true,
                updateBefore: true,
                prevhtml: ' <a href="#" class="prev-nav"><i class="icon-517"></i></a> ',
                nexthtml: ' <a href="#" class="next-nav"><i class="icon-501"></i></a> ',
                controlsattr: 'id="controls"',
                numericattr: 'class="slider-nav"'
            });
            jQuery(".event-slider").sudoSlider({
                numeric: false,
                responsive: true,
                controlsShow: false,
                moveCount: 1,
                speed: 1e3,
                auto: false,
                continuous: true,
                updateBefore: true,
                customLink: ".event-nav a, #controls > a"
            });
            jQuery(".event-nav").sudoSlider({
                numeric: false,
                controlsShow: false,
                responsive: true,
                slideCount: 4,
                moveCount: 1,
                speed: 500,
                continuous: true,
                updateBefore: true,
                customLink: ".event-nav a, #controls > a"
            })
        },
        knob: function() {
            function e() {
                jQuery(".statistic-item").each(function() {
                    var e = jQuery(this).val(),
                        t = jQuery(this),
                        n = 0,
                        r = setInterval(function() {
                            if (n <= e) {
                                t.val(n).trigger("change");
                                n++
                            } else {
                                clearInterval(r)
                            }
                        }, 50)
                })
            }
            jQuery(".statistic-item").knob({
                thickness: ".1",
                lineCap: "round",
                fgColor: "#ffffff",
                bgColor: "rgba(255,255,255,0.2)",
                readOnly: true,
                displayInput: true,
                font: "Oxygen",
                fontWeight: "300",
                step: 1
            });
            e()
        },
        progressBar: function() {
            var e = jQuery(".progresive-bar-items > li"),
                t = jQuery(".progresive-bar-items > li span");
            e.each(function(e) {
                var n = t.eq(e).data("progress");
                var r = 100;
                n = 100 - n;
                var i = setInterval(function() {
                    if (r > n) {
                        if (r % 2 == 0) {
                            r = r + 3
                        } else {
                            r = r - 5
                        }
                        t.eq(e).css("right", r + "%")
                    } else {
                        clearInterval(i)
                    }
                }, 20)
            })
        },
        datePicker: function() {
            jQuery("#check-in").datetimepicker({
                format: "Y-m-d",
                onShow: function(e) {
                    this.setOptions({
						minDate:'+0D'						
                       // maxDate: jQuery("#check-out").val() ? jQuery("#check-out").val() : false
                    })
                },
                timepicker: false
            });			
            jQuery("#check-out").datetimepicker({
                format: "Y-m-d",
                onShow: function(e) {
                    this.setOptions({
						// minDate: jQuery("#check-in").val() ? jQuery("#check-in").val() : false,
						minDate: jQuery("#check-in").val() ? jQuery("#check-in").val() : '+0D'						
                    })
                },
                timepicker: false
            });
        },
        roomSelect: function() {
            var e = jQuery(".room-select").parent();
            e.click(function(t) {
                t.preventDefault();
                e.not(jQuery(this)).find("ul").hide();
                jQuery(this).find("ul").toggle()
            });
            jQuery("html").click(function() {
                e.find("ul").hide()
            });
            e.each(function(e, t) {
                jQuery(this).click(function(e) {
                    e.stopPropagation()
                })
            });
            e.each(function(e, t) {
                jQuery(this).find("ul li").click(function(e) {
                    e.preventDefault();
                    jQuery(this).parent().parent().find("input").attr("value", jQuery(this).text())
                })
            })
        },
        zoomImage: function() {
            jQuery(".zoom-image").swipebox()
        },
        customScroll: function() {
            if (jQuery("#custom-scroll").length) {
                var e = jQuery("#custom-scroll"),
                    t = e.height(),
                    n = jQuery("#custom-scroll > ul"),
                    r = n[0].scrollHeight,
                    i = r - t,
                    s = jQuery(".scroll-bar span"),
                    o = Math.round(Math.round(t / r * 100) / 100 * t),
                    u = t - o,
                    a;
                if (r > t) {
                    s.height(o);
                    n.scroll(function() {
                        a = jQuery(this).scrollTop();
                        s.css("top", Math.round(a / u * 100))
                    })
                } else {
                    s.parent().hide()
                }
            }
        }
    };
    teslaThemes.init()
})(jQuery)