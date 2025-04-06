 <x-admin-panel-layout>
        <x-slot name="title">
            ایجاد فرم جدید
        </x-slot>
        <x-slot name="main">
    <div>
        <h4> ایجاد فرم جدید</h4>
        <div class="p-3 mb-2 bg-info text-dark mt-3" style="    border-radius: 10px;">
            کد کوتاه فرم:
            <span style="    direction: ltr;
    text-align: left;
    display: inline-block;">[form id="{{ $form_id }}"]</span>
            <br>
            برای نمایش فرم این کد را کپی کنید و در محتوای صفحه مورد نظر خود بگذارید
        </div>
        <div class="p-3 mb-2 bg-info text-dark " style="    border-radius: 10px;">
                کد کوتاه فرم:
                <span style="    direction: ltr;
    text-align: left;
    display: inline-block;">[form_entrance id="{{ $form_id }}"]</span>
                <br>
            برای نمایش ورودی های این فرم این کد را کپی کنید و در محتوای صفحه مورد نظر خود بگذارید
        </div>
        <p class="mt-5"><input type="text" id="name" placeholder="نام فرم" name="name" value="{{old("name")}}"></p>
        <div id='fb-editor'></div>
    </div>

    @push("admin-scripts")
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="https://formbuilder.online/assets/js/vendor.min.js"></script>

        <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
        <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
        <script>

                var options = {
                        i18n: {
                            locale: 'fa-IR',
                            location: '{{ asset("/admin/assets/lang") }}'
                        },

                        onSave: function(evt, formData) {
                            jQuery.post({
                                url: "{{ route("admin_create_form") }}",
                                data: {
                                    form:formData,
                                    name:jQuery("#name").val(),
                                    _token:"{{ csrf_token() }}"
                                },
                                success: function (data){
                                    window.location="{{ route("admin_list_forms") }}"
                                },

                            }
                            )
                        },
                        formData:[
                            {
                                "type": "hidden",
                                "name": "form_id",
                                "value": "{{ $form_id }}",
                                "access": false
                            },
                            {
                                "type": "button",
                                "subtype": "submit",
                                "label": "ارسال",
                                "className": "btn-default btn form_submit_btn",
                                "access": false,
                                "style": "default"
                            }

                        ],

                    },
                    $fbTemplate = $(document.getElementById('fb-editor'));
                $fbTemplate.formBuilder(options);


        </script>
    @endpush
            <style>
                ul.frmb li:nth-child(1) {
                    display: none;
                }
            </style>
        </x-slot>
    </x-admin-panel-layout>
