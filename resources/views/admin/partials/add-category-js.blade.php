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
    jQuery(".btn-add-category").click(function (e){
       e.preventDefault();
       jQuery(".form-add-category").toggleClass("d-none");
    })

    jQuery(".btn-submit-category").click(function (e){
        e.preventDefault();
        jQuery(".category-loading .admin-ajax-loading").addClass("active")

        var category_name=jQuery("input[name=category_name]").val();
        var category_post_type=jQuery("input[name=category_post_type]").val();
        var category_slug=jQuery("input[name=category_slug]").val();
        var category_parent=jQuery("select[name=category_parent]").val();
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        jQuery.ajax({
            type: "POST",

            url: `{{ route("admin_add_category") }}`,

            data: {
                "name": category_name,
                "type":category_post_type,
                "slug" : category_slug,
                "parent" : category_parent
            },
            success: function (data) {
                jQuery(".category-loading .admin-ajax-loading").removeClass("active")
                var item=`<li><input type="checkbox" name="{{$checkbox_name}}[]" value="${data.id}"> <label for="">${data.name}</label></li>`
                document.querySelector(".category-list").insertAdjacentHTML("beforeend",item);

                toastMessage("دسته بندی با موفقیت اضافه شد","موفق","success","#2c7873")
            },
            error: function (data){
                jQuery(".category-loading .admin-ajax-loading").removeClass("active")

                if(data.responseJSON.errors) {
                    jQuery.each(data.responseJSON.errors, function (key, item) {
                        toastMessage(item,"ارور","error",'#ff3632');

                    });
                }
            }
        })
    })

</script>
