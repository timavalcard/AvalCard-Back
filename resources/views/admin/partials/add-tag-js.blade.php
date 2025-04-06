<script>
    function toastMessage(text,heading="موفق",type="success",loaderBg="#90e084"){
        jQuery.toast({
            text : text,
            showHideTransition : 'slide',  // It can be plain, fade or slide
            heading: heading,
            icon: type,
            loader: true,        // Change it to false to disable loader
            loaderBg: loaderBg,
            textAlign: 'right'
        })
    }
    jQuery(".btn-add-tag").click(function (e){
       e.preventDefault();
       jQuery(".form-add-tag").toggleClass("d-none");
    })

    jQuery(".btn-submit-tag").click(function (e){
        e.preventDefault();
        jQuery(".tag-loading .admin-ajax-loading").addClass("active")

        var tag_name=jQuery("input[name=tag_name]").val();
        var tag_post_type=jQuery("input[name=tag_post_type]").val();
        var tag_slug=jQuery("input[name=tag_slug]").val();
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        jQuery.ajax({
            type: "POST",

            url: `{{ route("admin_add_tag") }}`,

            data: {
                "name": tag_name,
                "post_type":tag_post_type,
                "slug" : tag_slug
            },
            success: function (data) {
                jQuery(".tag-loading .admin-ajax-loading").removeClass("active")
                var item=`<li><input type="checkbox" name="{{$checkbox_name}}[]" value="${data.id}"> <label for="">${data.name}</label></li>`
                document.querySelector(".tag-list").insertAdjacentHTML("beforeend",item);

                toastMessage("دسته بندی با موفقیت اضافه شد","موفق","success","#2c7873")
            },
            error: function (data){
                jQuery(".tag-loading .admin-ajax-loading").removeClass("active")

                if(data.responseJSON.errors) {
                    jQuery.each(data.responseJSON.errors, function (key, item) {
                        toastMessage(item,"ارور","error","#ff3632")
                    });
                }
            }
        })
    })

</script>
