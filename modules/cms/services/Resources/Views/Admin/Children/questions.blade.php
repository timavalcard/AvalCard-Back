@extends("admin.adminMain.main")
@section("admin_title")

    لیست سوالات خدمت {{ $service->name }}
@endsection

@section("AdminContent")

        <div class="col-12">
            <h3 class="mt-5 mb-4">سوالات خدمت : {{$service->name}}</h3>
            <form action="{{ route("admin_sub_service_add_questions",["id"=>$service->id]) }}" method="post">
                @csrf
                <div class="service-questions-add_box">

                 @foreach($questions as $question_section_id=>$question_section)
                    <div class="service-questions-add_box_item" data-section="{{ $question_section_id }}">
                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>سکشن {{ $question_section_id }}</h5>
                            <div class="d-flex align-items-center">
                                <span class="admin-metabox-item-btn-delete ml-3"><button class="btn btn-danger btn-sm delete_questions_section">حذف این سکشن</button></span>
                                <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                            </div>

                        </div>
                        <div class="col-12 form-item  pt-3">


                            <div class="description mb-3 ">
                                برای اضافه کردن سوال به این سکشن نوع سوال انتخابی خود را از بین موارد زیر انتخاب کنید و روی دکمه افزودن کلیک کنید

                            </div>
                            <p class="form-field">
                                @includeif('Services::Admin.Children.questions_select_items')
                            </p>
                            <p class="form-field">
                                <button type="submit" class="btn btn_add_question_to_modal btn-primary">افزودن سوال</button>
                            </p>

                            <div class="service-questions-list_box">
                        <h3 class="mt-5 mb-3">لیست سوالات</h3>
                                <div class="service-questions-list_box_box">
                                    @foreach($question_section as $question_id=>$question)
                                        <div class="service-questions-item">
                                        <div class="admin-metabox-item metabox-close">
                                            <div class="admin-metabox-item-title"><h5>{{ $question["question"] }}</h5>
                                                <div class="d-flex">
                                                    <span class="admin-metabox-item-btn-delete ml-3 btn btn-sm btn-outline-danger align-items-center d-flex"><i class="fa fa-times"></i></span>
                                                    <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                                                </div>

                                            </div>
                                            <div class="col-12 form-item  pt-3" style="display: none;">
                                                <input type="hidden" value="{{ $question["question_type"] }}" name="question_type_[{{ $question_section_id }}][{{ $question_id }}]">
                                                <p>
                                                    <label>متن سوال</label>
                                                    <input type="text" name="question_[1][1]" value="{{ $question["question"] }}" class="service-questions-item_question_name">
                                                </p>
                                                <p class="mb-0">
                                                    <input class="ml-2" @if($question["question_required"] == "on") checked @endif type="checkbox" name="question_required_[{{ $question_section_id }}][{{ $question_id }}]">
                                                    <label for="">آیا پاسخ دادن به این سوال اجباری است؟</label>
                                                </p>
                                                @if(!empty($question["question_options"]))
                                                    <div class="modal-type-content question-type-multiple-box select checkbox radio mt-5">

                                                    <h7>مقدار های قابل انتخاب این سوال را وارد کنید</h7>
                                                    <div class="question-type-multiple-box-items">
                                                        @foreach($question["question_options"] as $question_options)
                                                             <div class="question-type-multiple-box-item">
                                                            <input placeholder="مقدار را وارد کنید..." type="text" class="w-50 p-1 mt-2" name="question_options_[{{ $question_section_id }}][{{ $question_id }}][]" value="{{ $question_options }}">
                                                            <button class="btn_delete_question_multiple_item btn text-danger"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        @endforeach

                                                    </div>
                                                    <div class="question-type-multiple-box-button">
                                                        <button class="btn my-3 question-type-multiple-button btn-outline-dark btn-sm" type="button">اضافه کردن مقدار جدید</button>
                                                    </div>

                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                    </div>
                        </div>
                    </div>


                </div>
                @endforeach


            </div>

                <button type="submit" class="btn-blue mt-5">ذخیره سوالات</button>
            </form>
            <div class="service-questions-add_section_box">
               <i class="fa fa-plus"></i>

            </div>


        </div>


        <div class="modal modal-add_question">
                <div class="modal-close pr-2 py-2">
                    <i class="btn btn-sm btn-outline-danger align-items-center d-inline-flex fa  fa-times"></i>
                </div>

               <div class="modal-content modal-add_question_content">
                   <div class="col-12 form-item  pt-3">
                       <input type="hidden" class="add_question_section_number" value="1">
                       <input type="hidden" class="add_question_type" value="text">
                       <p>
                            <label>متن سوال</label>
                           <input type="text" class="add_questions_question_text" >
                       </p>
                       <p class="mt-2">
                           <input id="modal_required_question" class="ml-2 add_questions_question_required"  type="checkbox">
                           <label for="modal_required_question">آیا پاسخ دادن به این سوال اجباری است؟</label>
                       </p>

                       <div class="modal-type-content my-4 d-none question-type-multiple-box select checkbox radio">
                            <h7>مقدار های قابل انتخاب این سوال را وارد کنید</h7>
                           <div class="question-type-multiple-box-items">
                               <div class="question-type-multiple-box-item">
                                        <input placeholder="مقدار را وارد کنید..." type="text" class="w-50 p-1 mt-2">
                                        <button class="btn_delete_question_multiple_item btn text-danger"><i class="fa fa-times"></i></button>
                               </div>
                           </div>
                            <div class="question-type-multiple-box-button">
                                <button class="btn my-3 question-type-multiple-button btn-outline-dark btn-sm" type="button">اضافه کردن مقدار جدید</button>
                            </div>
                       </div>





                   </div>
               </div>
                <div class="modal-add_btn modal-add_question_content p-2">
                    <button class="btn-blue add_question_to_section_btn">اضافه کردن سوال</button>
                </div>
        </div>

   @includeIf('admin.partials.delete_modal')

    @push("admin-scripts")
        <script>

            jQuery(".service-questions-add_section_box").click(function (){
                var section_count=jQuery(".service-questions-add_box_item:last-child").data('section') + 1 ;
                if(Number.isNaN(section_count)){
                    section_count=1
                }
                var item=`<div class="service-questions-add_box_item" data-section="${section_count}">
                    <div class="admin-metabox-item metabox-close">
                        <div class="admin-metabox-item-title"><h5>سکشن ${ section_count }</h5>
                            <div class="d-flex align-items-center">
                                <span class="admin-metabox-item-btn-delete ml-3"><button class="btn btn-danger btn-sm delete_questions_section">حذف این سکشن</button></span>
                                <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                            </div>

                        </div>
                        <div class="col-12 form-item  pt-3">
                <div class="description mb-3 ">
                    برای اضافه کردن سوال به این سکشن نوع سوال انتخابی خود را از بین موارد زیر انتخاب کنید و روی دکمه افزودن کلیک کنید

                </div>
                <p class="form-field">
@includeif('Services::Admin.Children.questions_select_items')
                </p>
                <p class="form-field">
                    <button type="submit" class="btn btn_add_question_to_modal btn-primary">افزودن سوال</button>
                </p>

                <div class="service-questions-list_box">
            <h3 class="mt-5 mb-3">لیست سوالات</h3>
            <div class="service-questions-list_box_box">

                                </div>
        </div>
            </div>
        </div>


    </div>`;

                document.querySelector(".service-questions-add_box").insertAdjacentHTML("beforeend",item)
            })



            jQuery(".admin-main-content").on("click",".delete_questions_section",function (e){
                jQuery(this).parents(".service-questions-add_box_item").remove()

            })

            jQuery("body").on("click",".btn_add_question_to_modal",function (e){
                e.preventDefault();
                var type=jQuery(this).parents(".service-questions-add_box_item").find("select").val();
                console.log(type)
                if(!type){
                    alert("ابتدا یک نوع سوال را انتخاب کنید")
                } else {
                    var section_number = jQuery(this).parents(".service-questions-add_box_item").data('section');
                    var question_name_number = jQuery(this).parents(".service-questions-add_box_item").find(".service-questions-item").length + 1
                    var question_name = `question_[${section_number}][${question_name_number}]`;
                    var type_name=`question_type_[${section_number}][${question_name_number}]`;
                    var required_name=`question_required_[${section_number}][${question_name_number}]`;
                    var question_option_name=`question_options_[${section_number}][${question_name_number}][]`;
                    jQuery(".modal-add_question").addClass("open")

                    jQuery(".add_question_section_number").val(section_number)
                    jQuery(".add_question_type").attr("name",type_name);
                    jQuery(".question-type-multiple-box-item input").attr("name",question_option_name);
                    jQuery(".add_question_type").val(type);

                    jQuery(".add_questions_question_text").attr("name",question_name)
                    jQuery(".add_questions_question_required").attr("name",required_name)

                    var multiple_question_box=jQuery(`.question-type-multiple-box.${type}`)
                    if(multiple_question_box){
                        multiple_question_box.removeClass("d-none")
                    } else{
                        multiple_question_box.addClass("d-none")
                    }
                }


            })

            jQuery(".modal-close").click(close_question_modal)

            jQuery(".admin-main-content").on("keyup",".question-type-multiple-box-item input",function (){
                jQuery(this).attr("value",jQuery(this).val());
            })

            jQuery(".add_question_to_section_btn").click(function (){
                var question_section=jQuery(".add_question_section_number").val()
                var section_to_add=jQuery(`.service-questions-add_box_item[data-section=${question_section}]`)[0]
                var question_name=jQuery(".add_questions_question_text").attr("name")
                var question_value=jQuery(".add_questions_question_text").val()
                var question_type_name=jQuery(".add_question_type").attr("name")
                var question_type_value=jQuery(".add_question_type").val()

                var question_required_name=jQuery(".add_questions_question_required").attr("name")
                var question_required_value=jQuery(".add_questions_question_required")[0].checked

                if(jQuery(`.question-type-multiple-box.${question_type_value}`)[0]){
                    var options=`<div class="modal-type-content question-type-multiple-box select checkbox radio mt-5">
                            ${ jQuery(".modal-content .question-type-multiple-box").html() }
                       </div>`
                }

                if(section_to_add){
                    var question_html=`<div class="service-questions-item">
                                <div class="admin-metabox-item metabox-close">
                                    <div class="admin-metabox-item-title"><h5>${question_value}</h5>
                                        <div class="d-flex">
                                            <span class="admin-metabox-item-btn-delete ml-3 btn btn-sm btn-outline-danger align-items-center d-flex"><i class="fa fa-times"></i></span>
                                            <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                                        </div>

                                    </div>
                                    <div class="col-12 form-item  pt-3">
                                        <input type="hidden" value="${question_type_value}" name="${question_type_name}">
                                        <p>
                                            <label>متن سوال</label>
                                            <input type="text" name="${question_name}" value="${question_value}" class="service-questions-item_question_name">
                                        </p>
                                        <p class="mb-0">
                                            <input class="ml-2" ${ question_required_value ? "checked" : ""  } type="checkbox" name="${question_required_name}">
                                            <label for="">آیا پاسخ دادن به این سوال اجباری است؟</label>
                                        </p>
                                        ${options ? options : ''}
                                    </div>
                                </div>
                            </div>`;
                    section_to_add.querySelector(".service-questions-list_box .service-questions-list_box_box").insertAdjacentHTML("beforeend",question_html)
                }
                close_question_modal()
            })


            function close_question_modal(){
                jQuery(".modal-add_question").removeClass("open")
                jQuery(".modal-add_question input,.modal-add_question select").val(null)
                jQuery(`.modal-content .question-type-multiple-box`).addClass("d-none")
                jQuery(".modal-content .question-type-multiple-box-item:not(:first-child)").remove()
                jQuery(".modal-content .question-type-multiple-box-item").val(null)
            }

            jQuery(".admin-main-content").on("keyup",".service-questions-item_question_name",function (){
                jQuery(this).parents(".service-questions-item").find(".admin-metabox-item-title h5").text(this.value)
            })

            jQuery(".admin-main-content").on("click",".admin-metabox-item-btn-delete",function (){
                jQuery(this).parents(".service-questions-item").remove()
            })


            jQuery(".admin-main-content").on("keyup",".question-type-multiple-box-item input",function (event){ add_question_multiple_item(event) } )
            jQuery(".admin-main-content").on("click",".question-type-multiple-button",function (event){ add_question_multiple_item(event) })

            function add_question_multiple_item(event){
                if(event.type == "click" || jQuery(event.target.closest(".question-type-multiple-box-item")).next(".question-type-multiple-box-item")[0] == undefined  ){
                    var section_number =jQuery(".add_question_section_number").val();
                    console.log(section_number)
                    if(!section_number){
                        section_number=jQuery(event.target).parents(".service-questions-add_box_item").data("section")
                    }
                    var section=jQuery(`.service-questions-add_box_item[data-section=${section_number}]`)[0]
                    var question_name_number = jQuery(section).find(".service-questions-item").length + 1
                    var options_name=`question_options_[${section_number}][${question_name_number}][]`;
                    var item=`<div class="question-type-multiple-box-item">
<input placeholder="مقدار را وارد کنید..." type="text" class="w-50 p-1 mt-2" name="${options_name}"><button class="btn_delete_question_multiple_item btn text-danger"><i class="fa fa-times"></i></button></div>`;
                    var parent=jQuery(event.target.closest(".question-type-multiple-box"))[0]
                    parent.querySelector(".question-type-multiple-box-items").insertAdjacentHTML("beforeend",item)

                }
                }


            jQuery(".admin-main-content").on("click",".btn_delete_question_multiple_item",function (){
                jQuery(this).parents(".question-type-multiple-box-item").remove()
            })
        </script>
    @endpush
@endsection
