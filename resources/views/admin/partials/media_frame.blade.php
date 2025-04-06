<div class="admin-frame-media-select">
    <span class="d-none delete-media-link">{{ route("admin_delete_media") }}</span>
    <div class="admin-frame-media-select-top">
        <h2>رسانه ها</h2>
        <div class="admin-frame-media-select-close">
            <i class="fa fa-times"></i>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="admin-frame-media-select-tab">
                <ul class="nav nav-tabs">
                    <li>
                        <a class="" data-toggle="tab" href="#upload">آپلود رسانه جدید</a>
                    </li>
                    <li>
                        <a class="active" data-toggle="tab" href="#uploaded">رسانه های اپلود شده</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="upload" class="tab-pane fade in  ">
                        <div class="w-100 text-center">
                            <h3>آپلود رسانه</h3>
                            <form id="uploadDatabaseForm" enctype="multipart/form-data" method="post" class="admin-media-form-file" action="{{ route("admin_add_media") }}">            @csrf
                                <input type="file" name="media_field[]" class="admin-media-input-file" multiple="">

                                <button class="admin-media-form-file-btn btn-blue">آپلود</button>        </form>        <span class="font-italic mt-3 mb-4 d-block">         برای آپلود چند تایی کلید cntrl را نگه دارید      </span>    </div>

                        @includeIf("admin.partials.ajax-loading")
                    </div>



                    <div id="uploaded" class="tab-pane fade in active show">
                        <div class="admin-frame-media-select-bottom">
                            <span class="admin-frame-media-select-btn btn-blue">استفاده از این رسانه</span>
                        </div>
                        <div class="admin-frame-media-select-center">
                            <div class="row">
                                @php($files=resolve(CMS\Media\Models\Media::class)->orderByDesc("created_at")->get())
                                @if($files)
                                    @foreach ($files as $media)
                                        <div class="col-6 col-md-3 col-lg-2 admin-frame-item">
                                            <a class="btn btn-danger admin-table-actions-delete admin-media-item-delete"
                                               href="{{ route("admin_delete_media",["media"=>$media->id]) }}"> <i class="fa fa-times"></i></a>
                                            <img data-alt="{{ $media->alt }}" data-src="{{ $media->getUrlAttribute()  }}" data-url="{{$media->getUrlAttribute(300)}}" data-id="{{$media->id}}">
                                        </div>

                                    @endforeach
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="media-information-box">
                <div class="media-information-box-content ">
                    <input type="hidden" id="media-id">
                    <span class="setting has-description mt-4 d-block" data-setting="alt">
                        <label for="media-alt" class="alt">آلت تصویر</label>
                        <input  type="text" id="media-alt" aria-describedby="alt-text-description">
                    </span>
                    <span class="setting has-description mt-4 d-block" data-setting="alt">
                        <label for="media-link" class="alt">لینک تصویر</label>
                        <input type="text" readonly id="media-link" aria-describedby="alt-text-description">
                    </span>
                    <span class="setting has-description mt-4 d-block copy-media-box" data-setting="alt">
                        <button class="btn btn-sm btn-primary copy-media-link">ذخیره لینک در کلیپ برد</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>

@push("admin-scripts")
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    <script>
        function toastMessage(text,heading="success",type="success",loaderBg="#90e084"){
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

        if (document.querySelector(".admin-frame-media-select")) {
            var gallery;
            var is_content;
            var img;
            var img_alt;
            var img_link;
            var img_id;
            var storeUrl="{{ store_image_link() }}/"
            jQuery("body").on("click",".open-admin-media-frame",openMedia);
            jQuery("body").on("openMedia","a.content_open_media",openMedia);
            function openMedia (e) {
                var images=jQuery("#uploaded img");
                for (var index=0;index<=images.length - 1;index++){
                    images[index].setAttribute("src",images[index].getAttribute("data-src"))
                }

                jQuery(".open-admin-media-frame").removeClass("active");
                if(e.target.closest(".open-admin-media-frame")){
                    e.target.closest(".open-admin-media-frame").classList.add("active");
                }

                if(e.target.classList.contains("open-admin-media-frame-gallery")){
                    gallery=true;
                }else{
                    gallery=false;
                }

                if(e.target.closest("td.cke_dialog_ui_hbox_last")){
                    gallery=false;
                    is_content=true;
                }
                e.preventDefault();
                document.querySelector(".admin-frame-media-select").style.cssText = "    right: auto;\n" +
                    "    left: 0;\n" +
                    "    transform: translateX(2%);"
            }
            document.querySelector(".admin-frame-media-select-close").addEventListener("click", function (e) {
                document.querySelector(".admin-frame-media-select").style.cssText = "right: -110vw;transform: unset;"
            });

            jQuery(".admin-frame-media-select-center").click(function (e) {
                if(e.target.tagName=="IMG"){
                    console.log(e.target.dataset.alt)

                    img=e.target.dataset.url;
                    img_id=e.target.dataset.id;
                    img_alt=e.target.dataset.alt !=undefined ? e.target.dataset.alt :"";
                    img_link=`{{ request()->getHost()  }}${e.target.dataset.src}`;
                    jQuery(".media-information-box-content").removeClass("d-none")
                    jQuery("#media-alt").val(img_alt);
                    jQuery("#media-link").val(img_link);
                    jQuery("#media-id").val(img_id);
                    jQuery(e.target.closest("div")).siblings().removeClass("active");
                    e.target.closest("div").classList.add("active")
                }
            });
            document.querySelector(".admin-frame-media-select-btn").addEventListener("click", function (e) {
                var alt=jQuery("input#media-alt").val();
                $.ajax({
                    type : 'post',
                    url : '{{ route("admin_save_media_alt") }}',
                    data:{
                        '_token':"{{ csrf_token() }}",
                        'id':jQuery("input#media-id").val(),
                        'alt':alt,
                    },
                });
                jQuery(".admin-frame-item.active img").attr("data-alt",alt)
                jQuery(".media-information-box-content").addClass("d-none")
                jQuery("#media-alt").val("");
                jQuery("#media-link").val("");
                jQuery("#media-id").val("");
                if(is_content){

                    var extension=img.split("_")[1]
                    extension=extension.split(".")[1]
                    img=img.split("_")[0]

                    jQuery("a.content_open_media").closest("tr.cke_dialog_ui_hbox").find("input").val(img+"."+extension)
                    jQuery("a.content_open_media").closest(".cke_dialog_ui_vbox.cke_dialog_page_contents").find(">table>tbody>tr:nth-child(2) input").val(alt)
                }
                else if(!gallery){
                    jQuery(".open-admin-media-frame.active").siblings(".admin-media-frame-input").val(img_id);
                    jQuery(".open-admin-media-frame.active").siblings("img").attr("src",  img) ;

                }
                else{

                    if(document.querySelectorAll(".admin-product-gallery-box input[value='"+img_id+"']").length >=1){
                        alert("این عکس در حال حاظر در گالری وجود دارد");
                    }else {
                        document.querySelector(".admin-product-gallery-box").insertAdjacentHTML("afterbegin", `
                         <div class="col-4 mb-2 gallery-item">
                            <span class="remove-gallery-item btn-danger"><i class="fa fa-times"></i></span>
                            <img src=${img}>
                               <input type="hidden" name="gallery_image[]" value="${img_id}">
                         </div>
                        `)
                    }
                }

                jQuery(".admin-frame-media-select-center div.active").removeClass("active");
                document.querySelector(".admin-frame-media-select").style.cssText = "right: -110vw;transform: unset;"
                jQuery(".open-admin-media-frame").removeClass("active");
            })
            jQuery(".admin-product-gallery-box").click(function (e) {
                if(e.target.closest("span").classList.contains("remove-gallery-item")){
                    jQuery(e.target.closest("span")).parents(".gallery-item").remove();
                }
            })

            jQuery(".admin-media-form-file").submit(function (e) {
                jQuery("#upload .admin-ajax-loading").addClass("active")
                e.preventDefault();
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery(".admin-media-form-file input[name='_token']").val()
                    }
                });
                jQuery.ajax({
                    type: "post",

                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    url: `{{ route("admin_add_media") }}`,

                    data:new FormData($(this)[0]),

                    success: function(data){
                        var alert=``;
                        document.querySelector(".admin-main-content").insertAdjacentHTML("afterbegin",alert);
                        jQuery(".admin-frame-media-select-tab .nav-tabs a[href='#uploaded']").click();
                        data.items.forEach(item=>{
                            console.log(item)
                            var itemHtml=`
                                <div class="col-6 col-md-3 col-lg-2 admin-frame-item">
                                    <a class="btn btn-danger admin-table-actions-delete admin-media-item-delete"
                                       href="{{ route("admin_delete_media",["media"=>""]) }}/${item.id}"> <i class="fa fa-times"></i></a>
                                    <img data-alt="${item.alt??""}" src="${storeUrl + item.files[100] }" data-src="${storeUrl + item.files[100] }" data-url="${ storeUrl + item.files[600] }" data-id="${item.id}">
                                </div>
                                `
                            document.querySelector(".admin-frame-media-select-center .row").insertAdjacentHTML("afterbegin",itemHtml)
                        })
                        jQuery("#upload .admin-ajax-loading").removeClass("active")
                        jQuery(".admin-media-input-file").val(null)
                        toastMessage("succesfull upload","success","success")
                    },
                    error: function (data){
                        jQuery("#upload .admin-ajax-loading").removeClass("active")

                        jQuery.each(data.responseJSON.errors, function (key, text) {
                            toastMessage(text,"error","error","#ff3632")
                        });
                    }

                });

            })

        }
        jQuery(".copy-media-link").click(function (e){
            e.preventDefault()
            copyTextToClipboard(jQuery("input#media-link").val())

            document.querySelector(".copy-media-box").insertAdjacentHTML("beforeend",`<span class="post-socials-icon__popup mt-3 alert alert-success alert-small">
      کپی شد
    </span>`)
            setTimeout(function (){
                jQuery("span.post-socials-icon__popup").remove()
            },2000)
        })
        function fallbackCopyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;

            // Avoid scrolling to bottom
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";

            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Fallback: Copying text command was ' + msg);
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }

            document.body.removeChild(textArea);
        }
        function copyTextToClipboard(text) {
            if (!navigator.clipboard) {
                fallbackCopyTextToClipboard(text);
                return;
            }
            navigator.clipboard.writeText(text).then(function() {
                console.log('Async: Copying to clipboard was successful!');
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }
    </script>
@endpush
