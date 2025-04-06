
@if(!isset($footer) || $footer!=false)

@endif


<script type="text/javascript" src="{{ theme_asset("js/owl.carousel.min.js") }}" id="carousel-js"></script>
<script type="text/javascript" src="{{ theme_asset("js/script.js?ver=".time()) }}" id="script-js"></script>
@stack("js")


    @if(session()->get("toast_message"))
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
        <script>
            jQuery.toast({
                text : '{{session()->get("toast_message")}}',
                showHideTransition : 'slide',  // It can be plain, fade or slide
                heading: '{{session()->get("toast_heading")}}',
                icon: '{{session()->get("toast_type")}}',
                loader: true,        // Change it to false to disable loader
                loaderBg: "#90e084",
                textAlign: 'right',
                hideAfter : 5000,
            })
        </script>
        @php
            session()->forget("toast_message");
            session()->forget("toast_heading");
            session()->forget("toast_type");
        @endphp
    @endif

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <script>
        jQuery("a:not(.not-trilling-slash)").each(function(){
            if(jQuery(this).parents("#nextpay").height() == undefined) {

                var href = this.href.replace(/\/?(\?|#|$)/, '/$1')
                jQuery(this).attr("href", href);
            }
        })
    </script>
</body>
</html>
