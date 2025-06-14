<style>
    button.select2-selection__clear {
        display: none;
    }
</style>
<script>
    var attr_index=0;

    let getProducts = (arrays) => {
        if (arrays.length === 0) {
            return [[]];
        }

        let results = [];

        getProducts(arrays.slice(1)).forEach((product) => {
            arrays[0].forEach((value) => {
                results.push([value].concat(product));
            });
        });

        return results;
    };

    let getAllCombinations = (attributes) => {
        let attributeNames = Object.keys(attributes);

        let attributeValues = attributeNames.map((name) => attributes[name]);

        return getProducts(attributeValues).map((product) => {
            obj = {};
            attributeNames.forEach((name, i) => {
                obj[name] = product[i];
            });
            return obj;
        });
    };
    function initSelect2() {
        jQuery('select[class^="variable-select_"]:not(.select2-hidden-accessible)').select2({
            width: 'resolve',
            placeholder: 'انتخاب کنید',
            allowClear: true,
            language: "fa" // اگر فارسی خواستی
        });
    }
    jQuery(document).ready(function() {
        initSelect2();
    });

    jQuery(".li-for-variable-tab").click(function () {
    })
    jQuery(".add-variable-btn").click(function (e) {
        e.preventDefault();
        var id ='{{ request()->id }}';
        if(id.length==0){
            id=jQuery("input[name=product_nick_name]").val()
        }

        var selectVariable=jQuery(".variable-select");
        var selectValue=selectVariable.val();

        if(selectValue == "variable_new"){

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery(".admin-media-form-file input[name='_token']").val()
                }
            });
            jQuery(".admin-ajax-loading").addClass("active")
            jQuery.ajax({
                type: "post",

                url: `{{ route("get_product_attribute_use_for_variable") }}`,

                data: {"product_id": id },

                success: function (data) {
                    var variable_item=`<div class="variable-item">
                                            <input type="hidden" value="" name="variation_priority[${attr_index}]" class="variation_priority">

                                            <section class="variable-item-top">
                                                <div class="variable-item-top-right">

                                                </div>
                                                <div class="variable-item-top-left">
                                                    <div class="variable-item-top-left-closeBtn">
                                                        <i class="fa fa-angle-down"></i>
                                                    </div>
                                                    <div class="variable-item-top-left-deleteBtn">
                                                        <span>حذف</span>
                                                    </div>
                                                </div>
                                            </section>
                                            <div class="variable-item-content">
                                                <div class="row">
                                                    <div class="col-md-6 variable-input-box">
                                                        <label>قیمت</label>
                                                        <input type="text" name="variable_price[${attr_index}]" placeholder="قیمت را وارد کنید">
                                                    </div>
                                                    <div class="col-md-6 variable-input-box">
                                                        <label>قیمت فروش ویژه</label>
                                                        <input type="text"  name="variable_offer_price[${attr_index}]" placeholder="قیمت  فروش ویژه را وارد کنید">
                                                    </div>
                                                    <div class="col-md-6 variable-input-box ">
                                                        <label>ارز</label>
                                                        <select  name="variation_currency[${attr_index}]">
                                                            <option value="137203" selected>دلار آمریکا</option>
                                                            <option value="137220">دلار کانادا</option>
                                                            <option value="137225">دلار هنگ کنگ</option>
                                                            <option value="137219">دلار استرالیا</option>
                                                            <option value="137206">پوند انگلیس</option>
                                                            <option value="137204">یورو</option>
                                                            <option value="137205">درهم امارات</option>
                                                            <option value="520837">رئال برزیل</option>
                                                            <option value="137209">ین ژاپن</option>
                                                            <option value="137221">یوان چین</option>
                                                            <option value="137224">لیر ترکیه</option>
                                                            <option value="137227">روپیه هند</option>
                                                            <option value="137211">دینار کویت</option>
                                                            <option value="520841">پزوی آرژانتین</option>
                                                            <option value="520846">هریونیا اوکراین</option>
                                                            <option value="520835">پزوی مکزیک</option>

                                                                            </select>

                                                                        </div>
                                                                        <div class="col-md-6 variable-input-box  d-none">
                                                                            <label>وزن (kg)</label>
                                                                            <input type="text"  name="variable_weight[${attr_index}]" placeholder="وزن را وارد کنید">
                                                    </div>

                                                    <div class="col-md-6 variable-input-box  d-none">
                                                        <label>ابعاد (L×W×H) (cm)</label>
                                                        <div class="row">
                                                             <div class="col-md-4">
                                                                <input type="text"  name="variable_length[${attr_index}]" placeholder="طول">
                                                             </div>
                                                            <div class="col-md-4">
                                                                <input type="text"  name="variable_width[${attr_index}]" placeholder="عرض">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text"  name="variable_height[${attr_index}]" placeholder="ارتفاع">
                                                            </div>
                                                        </div>

                                                    </div>
 <div class="variable-input-box col-12">
                                                            <p class=" d-none">
                                                                <label for="">شناسه محصول</label>
                                                                <input type="text" name="variable_sku[${attr_index}]">
                                                            </p>
                                                            <p class=" d-none">
                                                                <input type="checkbox" name="variable_manage_stock[${attr_index}]">
                                                                <label for="">مدیریت موجودی انبار؟</label>
                                                            </p>



                                                            <div class="manage-stock-number d-none">
                                                                <p>
                                                                    <label for="">تعداد موجود در انبار.</label>
                                                                    <input type="text" name="variable_stock_number[${attr_index}]" >
                                                                </p>
                                                                <p class=" d-none">
                                                                    <label for="">آستانه کم‌بودن موجودی انبار.</label>
                                                                    <input type="number" name="variable_low_stock_amount[${attr_index}]">
                                                                </p>
                                                            </div>

                                                        </div>
                                                </div>
                                            </div>
                                        </div>`;
                    document.querySelector(".variable-items-box").insertAdjacentHTML("afterbegin",variable_item);
                    var first_variable=document.querySelector(".variable-items-box .variable-item:first-child .variable-item-top-right");
                    Object.entries(data).forEach(i => {
                        first_variable.insertAdjacentHTML("afterbegin",`
                         <div class="variable-item-top-right-select-item">
                                                        <select class="variable-select_${i[0]}" name='attribute_select[${attr_index}][${i[1].parent.id}]'>
                                                            <option value="" selected>${i[1].parent.name}</option>
                                                        </select>
                                                    </div>

                        `)


                        var variable_select=document.querySelector(`.variable-select_${i[0]}`);
                        Object.entries(i[1].values).forEach(v => {
                            variable_select.insertAdjacentHTML("beforeend",`
                                <option value="${v[1].id}" >${v[1].name }</option>
                            `)
                        })
                        initSelect2();
                    })
                    attr_index++;
                    jQuery(".admin-ajax-loading").removeClass("active")
                }
            })

        }

        if(selectValue == "make_all_variable"){
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery(".admin-media-form-file input[name='_token']").val()
                }
            });
            jQuery(".admin-ajax-loading").addClass("active")
            jQuery.ajax({
                type: "post",

                url: `{{ route("get_product_attribute_use_for_variable") }}`,

                data: {"product_id": id },

                success: function (data) {
                    varitaions_count=1
                    attributes={};
                    Object.entries(data).forEach(i => {
                        varitaions_count *= i[1].values.length
                        attributes[i[1].parent.name] = i[1].values
                    })

                    combinations=getAllCombinations(attributes)

                    for(x=1;x<=varitaions_count;x++){
                        var variable_item=`<div class="variable-item">
                                            <input type="hidden" value="" name="variation_priority[${attr_index}]" class="variation_priority">

                                            <section class="variable-item-top">
                                                <div class="variable-item-top-right">

                                                </div>
                                                <div class="variable-item-top-left">
                                                    <div class="variable-item-top-left-closeBtn">
                                                        <i class="fa fa-angle-down"></i>
                                                    </div>
                                                    <div class="variable-item-top-left-deleteBtn">
                                                        <span>حذف</span>
                                                    </div>
                                                </div>
                                            </section>
                                            <div class="variable-item-content">
                                                <div class="row">
                                                    <div class="col-md-6 variable-input-box">
                                                        <label>قیمت</label>
                                                        <input type="text" name="variable_price[${attr_index}]" placeholder="قیمت را وارد کنید">
                                                    </div>
                                                    <div class="col-md-6 variable-input-box">
                                                        <label>قیمت فروش ویژه</label>
                                                        <input type="text"  name="variable_offer_price[${attr_index}]" placeholder="قیمت  فروش ویژه را وارد کنید">
                                                    </div>
                                                    <div class="col-md-6 variable-input-box ">
                                                        <label>ارز</label>
                                                        <select  name="variation_currency[${attr_index}]">

                                                            <option value="137203" selected>دلار آمریکا</option>
                                                            <option value="137220">دلار کانادا</option>
                                                            <option value="137225">دلار هنگ کنگ</option>
                                                            <option value="137219">دلار استرالیا</option>
                                                            <option value="137206">پوند انگلیس</option>
                                                            <option value="137204">یورو</option>
                                                            <option value="137205">درهم امارات</option>
                                                            <option value="520837">رئال برزیل</option>
                                                            <option value="137209">ین ژاپن</option>
                                                            <option value="137221">یوان چین</option>
                                                            <option value="137224">لیر ترکیه</option>
                                                            <option value="137227">روپیه هند</option>
                                                            <option value="137211">دینار کویت</option>
<option value="520841">پزوی آرژانتین</option>
                                                            <option value="520846">هریونیا اوکراین</option>
                                                            <option value="520835">پزوی مکزیک</option>
                                                                                </select>

                                                                            </div>
                                                                            <div class="col-md-6 variable-input-box  d-none">
                                                                                <label>وزن (kg)</label>
                                                                                <input type="text"  name="variable_weight[${attr_index}]" placeholder="وزن را وارد کنید">
                                                    </div>

                                                    <div class="col-md-6 variable-input-box  d-none">
                                                        <label>ابعاد (L×W×H) (cm)</label>
                                                        <div class="row">
                                                             <div class="col-md-4">
                                                                <input type="text"  name="variable_length[${attr_index}]" placeholder="طول">
                                                             </div>
                                                            <div class="col-md-4">
                                                                <input type="text"  name="variable_width[${attr_index}]" placeholder="عرض">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text"  name="variable_height[${attr_index}]" placeholder="ارتفاع">
                                                            </div>
                                                        </div>

                                                    </div>
 <div class="variable-input-box col-12">
                                                            <p class=" d-none">
                                                                <label for="">شناسه محصول</label>
                                                                <input type="text" name="variable_sku[${attr_index}]">
                                                            </p>
                                                            <p class=" d-none">
                                                                <input type="checkbox" name="variable_manage_stock[${attr_index}]">
                                                                <label for="">مدیریت موجودی انبار؟</label>
                                                            </p>



                                                            <div class="manage-stock-number d-none">
                                                                <p>
                                                                    <label for="">تعداد موجود در انبار.</label>
                                                                    <input type="text" name="variable_stock_number[${attr_index}]" >
                                                                </p>
                                                                <p class=" d-none">
                                                                    <label for="">آستانه کم‌بودن موجودی انبار.</label>
                                                                    <input type="number" name="variable_low_stock_amount[${attr_index}]">
                                                                </p>
                                                            </div>

                                                        </div>
                                                </div>
                                            </div>
                                        </div>`;
                        document.querySelector(".variable-items-box").insertAdjacentHTML("afterbegin",variable_item);
                        var first_variable=document.querySelector(".variable-items-box .variable-item:first-child .variable-item-top-right");


                        Object.entries(data).forEach(i => {
                            first_variable.insertAdjacentHTML("afterbegin",`
                         <div class="variable-item-top-right-select-item">
                                                        <select class="variable-select_${i[0]}" name='attribute_select[${attr_index}][${i[1].parent.id}]'>
                                                            <option value="">${i[1].parent.name}</option>
                                                        </select>
                                                    </div>

                        `)


                            var variable_select=document.querySelector(`.variable-select_${i[0]}`);
                                current_combination=combinations[x - 1][i[1].parent.name]

                            Object.entries(i[1].values).forEach((v,index) => {
                                variable_select.insertAdjacentHTML("beforeend",`
                                <option ${ v[1].id == current_combination.id ? "selected" : "" } value="${v[1].id}" >${v[1].name }</option>
                            `)
                            })
                            initSelect2();
                        })
                        attr_index++;
                    }

                    jQuery(".admin-ajax-loading").removeClass("active")
                }
            })
        }
    });

    jQuery("#variable").click(function (e) {
        var section=e.target.closest("section");
        if(section.classList.contains("variable-item-top") && e.target.tagName != "SELECT" && e.target.tagName != "OPTION" && e.target.tagName != "SPAN" && !e.target.classList.contains("variable-item-top-left-deleteBtn") ){

            jQuery(section).parents(".variable-item").children(".variable-item-content").stop().slideToggle(400)
            jQuery(section).parents(".variable-item").toggleClass("open")
        }
        else if(e.target.closest("div").classList.contains("variable-item-top-left-deleteBtn")){
            var parent=e.target.closest(".variable-item");
            if(confirm("از حذف این متغیر اطمینان دارید؟")){
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery(".admin-media-form-file input[name='_token']").val()
                    }
                });
                var variation_id_for_delete=jQuery(parent).find("input.variation_id").val()
                if(variation_id_for_delete) {
                    jQuery.ajax({
                        type: "DELETE",

                        url: `{{ route("remove_product_variation") }}`,

                        data: {"variation_id": variation_id_for_delete},
                        success: function (data) {
                            parent.remove();
                        }
                    })
                } else{
                    parent.remove();
                }

            }
        }
    });

    jQuery("input#variations_price").keyup(function (){
        jQuery("input[name^=variable_price]").val(jQuery(this).val())
    })

    jQuery("input#variations_offer_price").keyup(function (){
        jQuery("input[name^=variable_offer_price]").val(jQuery(this).val())
    })


    jQuery("body").on("keyup" , "[name^=variable_stock_number]",function (){
        if(jQuery(this).val()){
            jQuery(this).parents(".variable-input-box").find('[type="checkbox"]').prop("checked","checked")
        } else{
            jQuery(this).parents(".variable-input-box").find('[type="checkbox"]').prop("checked",false)
        }

    })

</script>
