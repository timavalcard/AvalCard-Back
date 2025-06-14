<script>

    $.fn.select2.amd.define('select2/selectAllAdapter', [
        'select2/utils',
        'select2/dropdown',
        'select2/dropdown/attachBody'
    ], function (Utils, Dropdown, AttachBody) {

        function SelectAll() { }

        SelectAll.prototype.render = function (decorated) {
            console.log(this)
            var self = this,
                $rendered = decorated.call(this),
                $selectAll = $(
                    '<button class="btn btn-xs btn-default" type="button" style="margin-left:6px;"><i class="fa fa-check-square-o"></i> Select All</button>'
                ),
                $unselectAll = $(
                    '<button class="btn btn-xs btn-default" type="button" style="margin-left:6px;"><i class="fa fa-square-o"></i> Unselect All</button>'
                ),
                $btnContainer = $('<div style="margin-top:3px;">').append($selectAll).append($unselectAll);
            if (!this.$element.prop("multiple")) {
                // this isn't a multi-select -> don't add the buttons!
                return $rendered;
            }
            $rendered.find('.select2-dropdown').prepend($btnContainer);
            $selectAll.on('click', function (e) {
                var $results = $rendered.find('.select2-results__option[aria-selected=false]');
                $results.each(function () {
                    self.trigger('select', {
                        data: $(this).data('data')
                    });
                });
                self.trigger('close');
            });
            $unselectAll.on('click', function (e) {
                var $results = $rendered.find('.select2-results__option[aria-selected=true]');
                $results.each(function () {
                    self.trigger('unselect', {
                        data: $(this).data('data')
                    });
                });
                self.trigger('close');
            });
            return $rendered;
        };

        return Utils.Decorate(
            Utils.Decorate(
                Dropdown,
                AttachBody
            ),
            SelectAll
        );

    });


    jQuery('.admin-product-list-ul a').click(function (e) {
        e.preventDefault();
        $(this).removeClass('active');

        $(".admin-product-list-ul a").removeClass('active');
    });

    if(jQuery("#vizhegi")) {


        jQuery(".admin-input-price").keyup(function (e) {
            var offerInput = jQuery(".admin-input-price-offer").val();
            if (Number(e.target.value) <= Number(offerInput)) {
                document.querySelector(".admin-span-price-offer").style.cssText = "display:inline-block !important";
            } else {
                document.querySelector(".admin-span-price-offer").style.cssText = "display:none !important";

            }
        })
        jQuery(".admin-input-price-offer").keyup(function (e) {
            var offerInput = jQuery(".admin-input-price").val();
            if (Number(e.target.value) >= Number(offerInput)) {
                document.querySelector(".admin-span-price-offer").style.cssText = "display:inline-block !important";
            } else {
                document.querySelector(".admin-span-price-offer").style.cssText = "display:none !important";

            }
        })

        jQuery(".add-vizhegi-btn").click(function (e) {
            e.preventDefault();
            let classItem = "";
            jQuery(".product-select-type").val() == "simple" ? classItem = "d-none" : "";
            if (jQuery(".vizhegi-select :selected").val() == "vizhegi-new") {
                document.querySelector(".vizhegi-items-box").insertAdjacentHTML("afterBegin", `
                          <div class="vizhegi-new-item vizhegi-item mt-4 ">
                                            <div class="vizhegi-new-item-top text-left">
                                                <span class="text-danger remove-vizhegi-item">پاک کردن این ویژگی</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>نام :</label>
                                                    <input type="text"  name="new_attribute_name[]">

                                                </div>
                                                <div class="col-md-9">
                                                    <label>مقدار ها ( با | مقدار هارا جدا کنید ):</label>
                                                    <textarea name="new_attribute_value[]"></textarea>
                                                    <div  class="mt-2">
                                                        <div class="vizhegi-item-checkbox">
                                                            <input type="checkbox" name="new_use_in_product[]">
                                                            <label> نمایش در برگه محصول</label>
                                                        </div>
                                                        <div class="vizhegi-item-checkbox for-variable ${classItem}">
                                                            <input type="checkbox" name="new_use_in_variable[]">
                                                            <label>استفاده  برای متغیر ها</label>
                                                        </div>
                                                    </div>
                                                    </div>
                                            </div>
                                        </div>
                    `)
            } else {
                let selectVizeghi = jQuery(".vizhegi-select");
                let attr_id = selectVizeghi.val()
                if (jQuery(`input[value='${jQuery(".vizhegi-select :selected").text()}`).height() > 0) {
                    alert("این ویژگی در حال حاظر انتخاب شده است")
                } else {
                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery(".admin-media-form-file input[name='_token']").val()
                        }
                    });
                    jQuery(".admin-ajax-loading").addClass("active")
                    jQuery.ajax({
                        type: "post",

                        url: `{{ route("get_product_attribute_value") }}`,

                        data: {"attribute_id": attr_id},

                        success: function (data) {
                            var attr_name = jQuery(".vizhegi-select :selected").text();
                            var attr_value = jQuery(".vizhegi-select :selected").val();
                            document.querySelector(".vizhegi-items-box").insertAdjacentHTML("afterBegin", `
                          <div class="vizhegi-new-item vizhegi-item mt-4 ">
                                            <div class="vizhegi-new-item-top text-left">
                                                <span class="text-danger remove-vizhegi-item">پاک کردن این ویژگی</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>نام :</label>
                                                    <input type="text" value="${attr_name}"  name="attribute_xx[]" readonly>
                                                    <input type="hidden" value="${attr_value}"  name="attribute_name[]">

                                                </div>
                                                <div class="col-md-9">
                                                    <label> مقدار(ها):</label>
                                                    <select class="item-${attr_id}" multiple="multiple"  name="attribute_value[${attr_value}][]">

                                                    </select>
                                                    <div class="attribute-select-all-btn mt-2">
                                                                <button type="button" class="btn-blue ml-2 selectAll">انتخاب همه</button>
                                                            </div>
                                                            <div  class="mt-2">
                                                        <input type="checkbox" name="use_in_product[${attr_value}]">
                                                        <label> نمایش در برگه محصول</label>
  <div class="vizhegi-item-checkbox for-variable ${classItem}">
                                                            <input type="checkbox" name="use_in_variable[${attr_value}]">
                                                            <label>استفاده  برای متغیر ها</label>
                                                        </div>
                                                    </div>
                                                    </div>

                                            </div>
                                        </div>
                    `);
                            Object.entries(data).forEach(i => {
                                document.querySelector(".item-" + attr_id).insertAdjacentHTML("beforeend", `
                                                        <option value='${i[0]}'>${i[0]}</option>
                                                        `);

                            });
                            $(".item-" + attr_id).select2({
                                tags: false,
                                tokenSeparators: [',', ' '],
                            });

                            jQuery(".admin-ajax-loading").removeClass("active")
                            jQuery(".vizhegi-select-box ").removeClass("d-none")
                        }
                    })
                }


            }
        })

        jQuery(".vizhegi-items-box").click(function (e) {

            if (e.target.classList.contains("remove-vizhegi-item")) {
                if (window.confirm("پاک کردن این ویژگی؟")) {
                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery(".admin-media-form-file input[name='_token']").val()
                        }
                    });
                    var attr_id_for_delete=$(e.target).parents(".vizhegi-item").find("input[name^='attribute_name']").val()
                    jQuery.ajax({
                        type: "DELETE",

                        url: `{{ route("remove_product_attribute_value",["id"=>request()->route()->parameter("id")]) }}`,

                        data: {"attribute_id": attr_id_for_delete},
                        success: function (data) {
                            $(e.target).parents(".vizhegi-item").remove();
                        }
                    })



                }
            }
        })

        jQuery(".product-select-type").change(function (e) {
            if (e.target.value == "variable") {
                jQuery(".for-variable").removeClass("d-none");
                jQuery(".for-sample").addClass("d-none");
            } else if (e.target.value == "simple") {
                jQuery(".for-variable").addClass("d-none");
                jQuery(".for-sample").removeClass("d-none");
            }
        })


        jQuery(".btn-save-attribute").click(function (e) {
            var id ='{{ request()->id }}';
            if(id.length==0){
                id=jQuery("input[name=product_nick_name]").val()
            }

            var attribute_name = [];
            $("input[name^=attribute_name]").each(function() {
                attribute_name.push($(this).val());
            });

            var attribute_value = {};
            $("select[name^=attribute_value]").each(function() {

                var numb = $(this).attr("name").match(/\d/g);
                numb = numb.join("");

                attribute_value[numb] = $(this).val();
            });

            var use_in_product = {};
            $("input[name^=use_in_product]").each(function() {
                var numb = $(this).attr("name").match(/\d/g);
                numb = numb.join("");

                use_in_product[numb] = this.checked == true ? "on" : "off";
            });
            var use_in_variable = {};
            $("input[name^=use_in_variable]").each(function() {
                var numb = $(this).attr("name").match(/\d/g);
                numb = numb.join("");

                use_in_variable[numb] = this.checked == true ? "on" : "off";
            });
            var type = jQuery("select[name=type]").val() ;

            var new_attribute_name = [];
            $("input[name^=new_attribute_name]").each(function() {
                new_attribute_name.push($(this).val());
            });
            var new_use_in_product = [];
            $("input[name^=new_use_in_product]").each(function() {
                new_use_in_product.push(this.checked == true ? "on" : "off");
            });

            var new_use_in_variable = [];
            $("input[name^=new_use_in_variable]").each(function() {
                new_use_in_variable.push(this.checked == true ? "on" : "off");
            });

            var new_attribute_value = [];
            $("textarea[name^=new_attribute_value]").each(function() {
                new_attribute_value.push($(this).val());
            });

            var name=jQuery('input[name="title"]').val()
            var slug=jQuery('input[name="slug"]').val()

            e.preventDefault();
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery(".admin-media-form-file input[name='_token']").val()
                }
            });
            jQuery(".admin-ajax-loading").addClass("active")
            jQuery.ajax({
                type: "post",

                url: `{{ route("save_product_attribute") }}`,

                data: {
                    "product_id": id,
                    "product_name": name,
                    "product_slug": slug,
                    "attribute_name" : attribute_name,
                    "attribute_value" : attribute_value,
                    "use_in_product" : use_in_product ,
                    "use_in_variable" : use_in_variable ,
                    "type" : type ,
                    "new_attribute_name" :new_attribute_name,
                    "new_use_in_product" :new_use_in_product,
                    "new_use_in_variable" :new_use_in_variable,
                    "new_attribute_value" :new_attribute_value,
                },

                success: function (data) {
                    console.log(data)
                    if(data){
                        jQuery(".vizhegi-select-box").removeClass("active")
                        jQuery('input[name="product_nick_name"]').val(data)
                        jQuery(".product-no-attrbiute-text").addClass("d-none")
                    }
                    jQuery(".admin-ajax-loading").removeClass("active")
                },
                error: function() {
                    jQuery(".admin-ajax-loading").removeClass("active")
                }
            })
        })

        jQuery("body").on("click",".selectAll",function(){
            jQuery(this).parents(".vizhegi-item").find("select option").prop("selected","selected");// Select All Options
            jQuery(this).parents(".vizhegi-item").find("select").trigger("change");
        })

    }
    $("input[name^='manage_stock']").change(remove_stock);
    $("input[name^='variable_manage_stock']").change(remove_stock);

    function remove_stock(){
        if( $(this).is(':checked') ) {
            this.closest("div").querySelector(".manage-stock-number").classList.remove("d-none")
        } else{
            this.closest("div").querySelector(".manage-stock-number").classList.add("d-none")
        }
    }


</script>
