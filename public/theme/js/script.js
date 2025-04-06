document.addEventListener("DOMContentLoaded", function() {
    var lazyImages = [].slice.call(document.querySelectorAll("img"));

    if ("IntersectionObserver" in window) {
        let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    if(jQuery(entry.target).parents(".page-post-content-content").height() == undefined && jQuery(entry.target).parents("#nextpay").height() == undefined &&  jQuery(entry.target).parents("#enamad").height() == undefined){
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove("lazy");
                        lazyImageObserver.unobserve(lazyImage);
                    }

                }
            });
        });

        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    } else {
        // Possibly fall back to event handlers here
    }
});


function toEnglishNumber(strNum) {
    var pn = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
    var en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
    var an = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    var cache = strNum;
    for (var i = 0; i < 10; i++) {
        var regex_fa = new RegExp(pn[i], "g");
        var regex_ar = new RegExp(an[i], "g");
        cache = cache.replace(regex_fa, en[i]);
        cache = cache.replace(regex_ar, en[i]);
    }
    return cache;
}

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
jQuery(".digits_reg_email ").keyup(function (e) {
    var text = e.target.value;
    if (validateEmail(text)) {
        text = text.split("@")[0];
    }
    jQuery("#digits_reg_username").val(text);
});

jQuery('.digits_register input[type="text"]').on("input", function () {
    var value = jQuery(this).val();
    //value=value.replace(/\s+/g,'');
    this.value = toEnglishNumber(value);
});
jQuery(document).ready(function (e) {
    e(".header-bottom-category").mouseenter(function () {
        e(".header-bottom-category-box").stop().slideDown(400);
    });
    e(".header-bottom-category").mouseleave(function () {
        e(".header-bottom-category-box").stop().slideUp(400);
    });
    window.addEventListener("scroll", function () {
        if (e(window).scrollTop() > o && e(window).scrollTop() > 20) {
            e("header.header .header-bottom").addClass("hide");
            e("header.header .header-bottom").removeClass("show");
        } else {
            e(window).scrollTop() <= o && e("header.header .header-bottom").removeClass("hide");
            e("header.header .header-bottom").addClass("show");
        }

        if (e(window).scrollTop() <= 120) {
            e("header.header .header-bottom").removeClass("show");
        }

        o = e(window).scrollTop();
    });

    if (document.querySelector(".header-bottom-content ul")) {
        var lists = document.querySelectorAll(".header-bottom-content ul li");
        setTimeout(function () {
            divA.style.width=document.querySelector(".header-bottom-content ul li.current-menu-item").offsetWidth + "px";
            divA.style.left = document.querySelector(".header-bottom-content ul li.current-menu-item").offsetLeft  + "px";
            //divA.style.borderBottom ="solid 3px #2c7873";
        }, 600);
        lists.forEach((i) => {
            i.addEventListener("mouseenter", function (e2) {
                divA.style.width=i.offsetWidth + "px";
                divA.style.left = i.offsetLeft   + "px";
                //divA.style.borderBottom ="solid 3px #2c7873";
                //divA.style.transform="rotateZ(45deg)";
            });
            i.addEventListener("click", function (e2) {
                e(i).siblings().removeClass("li-active");
                i.classList.add("li-active");
            });
        });
        document.querySelector(".header-bottom-content ul").addEventListener("mouseleave", function (e2) {
            if (document.querySelector(".header-bottom-content ul .current_page_item")) {
                divA.style.width=document.querySelector(".header-bottom-content ul .current_page_item").offsetWidth + "px";
                // divA.style.left = document.querySelector(".header-bottom-content ul .current_page_item").offsetLeft + document.querySelector(".header-bottom-content ul .current_page_item").offsetWidth - 40  + "px";
                divA.style.left = document.querySelector(".header-bottom-content ul li.current-menu-item").offsetLeft  + "px";
                //divA.style.borderBottom ="solid 3px #2c7873";
                //divA.style.transform="rotateZ(45deg)";
            } else {
                if (e(".header-bottom-content ul li.current-menu-item").height() > 0) {
                    divA.style.width=document.querySelector(".header-bottom-content ul li.current-menu-item").offsetWidth + "px";
                    divA.style.left = document.querySelector(".header-bottom-content ul li.current-menu-item").offsetLeft  + "px";
                    //divA.style.borderBottom ="solid 3px #2c7873";
                    //divA.style.transform="rotateZ(45deg)";
                } else {
                    //divA.style.transform="rotateZ(45deg)";
                    //divA.style.borderBottom ="solid 3px transparent";
                }
            }
        });
    }

    /* e("header .header-bottom-category a").attr("target","_blank");
    e("header .header-bottom-content a").attr("target","_blank");*/
    e("header .menu-responsive .header-bottom-category .header-bottom-category-box").slideUp(0),
        e("header .menu-responsive .header-bottom-category span").click(function () {
            e("header .menu-responsive .header-bottom-category .header-bottom-category-box").slideToggle(1e3);
        }),
        e(".slider-home").owlCarousel({ items: 1, loop: true, margin: 10, autoplay: !0, autoplayTimeout: 10000, autoplayHoverPause: !0, rtl: !0, nav: !0, dot: !0 }),
        e(".slider-blog").owlCarousel({
            items: 2,
            loop: true,
            margin: 10,
            autoplay: !0,
            autoplayTimeout: 8e3,
            autoplayHoverPause: !0,
            rtl: !0,
            nav: !1,
            dot: !0,
            responsive: {
                0: {items: 1, margin: 5},
                992: {items: 2, margin: 10},
            }
        }),
        e(".owl-course").owlCarousel({
            items: 3,
            loop: true,
            margin: 0,
            autoplay: !1,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0,
            rtl: !0,
            nav: !0,
            dot: !0,
            responsive: {
                0: { items: 1, margin: 5 },
                550: { items: 1, margin: 10 },
                768: { items: 2, margin: 20 },
                992: { items: 3, margin: 20 },
                1200: { items: 3, margin: 10 } },
        }),
        e(".owl-partner").owlCarousel({
            items:5,
            loop: true,
            margin: 0,
            autoplay: !1,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0,
            rtl: !0,
            nav: !0,
            dot: !0,
            responsive: {
                0: { items: 1, margin: 5 },
                550: { items: 1, margin: 10 },
                768: { items: 1, margin: 20 },
                800: { items: 3, margin: 10 },
                992: { items: 4, margin: 15 },
                1200: { items: 5, margin: 15 } },
        }),
        e(".owl-product").owlCarousel({
            items: 4,
            loop: true,
            margin: 0,
            autoplay: !1,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0,
            rtl: !0,
            nav: !0,
            dot: !0,
            responsive: {
                0: { items: 2, margin: 15 },
                550: { items: 2, margin: 15 },
                768: { items: 2, margin: 15 },
                800: { items: 3, margin: 15 },
                992: { items: 5, margin: 15 },
                1200: { items: 6, margin: 15 },
                1700: { items: 6, margin: 15 },}
        }),
        e(".owl-post").owlCarousel({
            items: 3,
            loop: true,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 3e3,
            autoplayHoverPause: true,
            rtl: true,
            nav: true,
            dot: false,
            responsive: {
                0: { items: 1, margin: 30 },
                550: { items: 1, margin: 30 },
                768: { items: 2, margin: 30 },
                800: { items: 2, margin: 30 },
                992: { items: 3, margin: 30 },
                1200: { items: 4, margin: 30 },
                1700: { items: 4, margin: 30 },
            },
        });
    e(".owl-post2").owlCarousel({
        items: 3,
        loop: true,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 3e3,
        autoplayHoverPause: true,
        rtl: true,
        nav: true,
        dot: false,
        responsive: {
            0: { items: 1, margin: 15 },
            550: { items: 1, margin: 15 },
            768: { items: 1, margin: 15 },
            800: { items: 2, margin: 15 },
            992: { items: 2, margin: 15 },
            1200: { items: 3, margin: 15 },
            1700: { items: 3, margin: 15 },
        },
    });
    e(".owl-insta").owlCarousel({ items: 1, loop: false, margin: 10, autoplay: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, rtl: !0, nav: !0, dot: !0 }),
        e(".owl-product2").owlCarousel({
            items: 3,
            loop: true,
            margin: 0,
            autoplay: !1,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0,
            rtl: !0,
            nav: !0,
            dot: !0,
            responsive: {
                0: { items: 1, margin: 15 },
                550: { items: 1, margin: 15 },
                768: { items: 1, margin: 15 },
                800: { items: 2, margin: 15 },
                992: { items: 3, margin: 15 },
                1200: { items: 5, margin: 15 },
                1700: { items: 5, margin: 15 },
            },
        }),
        e(".owl-category").owlCarousel({
            items: 3,
            loop: true,
            margin: 0,
            autoplay: !1,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0,
            rtl: !0,
            nav: !0,
            dot: !0,
            responsive: {
                0: { items: 2, margin: 15 },
                550: { items: 2, margin: 15 },
                768: { items: 2, margin: 15 },
                800: { items: 3, margin: 15 },
                992: { items: 4, margin: 15 },
                1200: { items: 5, margin: 15 },
                1700: { items: 5, margin: 15 },
            },
        }),
        e(".owl-product3").owlCarousel({
            items: 1,
            loop: false,
            margin: 20,
            autoplay: !1,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0,
            rtl: !0,
            nav: !0,
            dot: !0,


        }),
        e(".owl-rand-product").owlCarousel({
            items: 3,
            loop: false,
            margin: 0,
            autoplay: !1,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0,
            rtl: !0,
            nav: !0,
            dot: !0,
            responsive:{
                0: { items: 1, margin: 5 },
                550: { items: 1, margin: 10 },
                768: { items: 2, margin: 20 },
                800: { items: 2, margin: 10 },
                992: { items: 3, margin: 20 },
                1200: { items: 4, margin: 8 },
                1700: { items: 4, margin: 15 },
            },
        }),
        e(".owl-related").owlCarousel({
            items: 5,
            loop: false,
            margin: 0,
            autoplay: !0,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0,
            rtl: !0,
            nav: !0,
            dot: !0,
            responsive: {
                0: { items: 1, margin: 10 },
                550: { items: 2, margin: 10 },
                768: { items: 2, margin: 20 },
                800: { items: 3, margin: 10 },
                992: { items: 3, margin: 20 },
                1200: { items: 5, margin: 15 },
                1700: { items: 5, margin: 15 },
            },
        });
    jQuery(".openMenuBtn").click(function(){
        jQuery(".header-bottom-content").toggleClass("open")
        jQuery(".header-bg").toggleClass("d-none")
    })
    jQuery(".header-bg").click(function(e){
        jQuery(".header-bottom-content").removeClass("open");
        jQuery(".header-bg").addClass("d-none")
    })
    var t = !0;
    if (document.querySelector(".showmenu-btn")) {
        document.querySelector(".showmenu-btn").addEventListener("click", function () {
            var e = document.querySelector(".menu-responsive ul");
            1 == t && (e.style.cssText = "transform:translateX(0);transition:.8s");
        });
    }
    if (document.querySelector(".menu-responsive .fa-angle-right")) {
        document.querySelector(".menu-responsive .fa-angle-right").addEventListener("click", function () {
            document.querySelector(".menu-responsive ul").style.cssText = "transform:translateX(100%);transition:.8s";
        });
    }
    e(".a-login") &&
    (e(".a-login").click(function () {
        e("#login").addClass("active"), e("#login").addClass("in"), e("#register").removeClass("active"), e("#register").removeClass("in");
    }),
        e(".a-register").click(function () {
            e("#register").addClass("active"), e("#register").addClass("in"), e("#login").removeClass("active"), e("#login").removeClass("in");
        }));
    var o = !0;
    document.querySelector(".form-vabilo") &&
    ((document.querySelector(".form-about-box .gform_wrapper .gform_footer input.button").value = "ارسال"),
        e(".form-vabilo input").focusin(function () {
            console.log("rrr"), (this.parentElement.parentElement.querySelector("label").style.cssText = "top:-30%;transform:translateY(0);color:#52de97;z-index:100"), (this.style.cssText = "border-color:#52de97");
        }),
        e(".form-vabilo input").focusout(function () {
            var e = this.parentElement.parentElement;
            "" == this.value && (e.querySelector("label").style.cssText = "top:43%;transform:translateY(-50%);color:#6e6e6e;z-index:1"), (this.style.cssText = "border-color:#acacac"), (e.querySelector("label").style.color = "#6e6e6e");
        }),
        (document.querySelector(".form-vabilo textarea ").parentElement.parentElement.querySelector("label").style.cssText = "top:10%;transform:translateY(-10%);color:#6e6e6e;z-index:1"),
        e(".form-vabilo textarea").focusin(function () {
            (this.parentElement.parentElement.querySelector("label").style.cssText = "top:-10%;transform:translateY(0);color:#52de97;z-index:100"), (this.style.cssText = "border-color:#52de97");
        }),
        e(".form-vabilo textarea").focusout(function () {
            var e = this.parentElement.parentElement;
            "" == this.value && (e.querySelector("label").style.cssText = "top:10px;transform:translateY(-10%);color:#6e6e6e;z-index:1"), (this.style.cssText = "border-color:#acacac"), (e.querySelector("label").style.color = "#6e6e6e");
        })),
    e(".woocommerce-product-gallery__image") &&
    (console.log("ds"),
        e(".woocommerce-product-gallery__image").click(function (e) {
            e.preventDefault();
        })),
        jQuery(".variations_form").on("show_variation", function () {
            document.querySelector(".single-product-box-top p.price").innerHTML=document.querySelector(".woocommerce-variation-price").innerHTML
        });
});






