import Sortable from 'sortablejs';

function toastMessage(text="عملیات موفقیت امیز بوذ",heading="موفق",type="success",loaderBg="#90e084"){
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
$(document).ready(function(){


    var bodyEl=jQuery("body");
    /*var unSaved=false;
    function before_leave_ask() {
        unSaved=true
    }
    window.onbeforeunload = function(){
        if(unSaved){
            return 'اطلاعات سیو نشده اند از انجام این کار اطمینان دارید؟';

        }else{
            return undefined;
        }
    };
    bodyEl.on("change","input", before_leave_ask);
    bodyEl.on("change","textarea", before_leave_ask);
    bodyEl.on("change","select", before_leave_ask);*/

    $("img").error(function(e){
        e.target.style.display='none';

    });
    $("img").on('load',function(e){
        e.target.style.display='inline-block';

    });

    $(".metabox-close .form-item").slideUp(0)
    $(".admin-main-content").on("click",".admin-metabox-item-title",function(e){
        $(e.target.closest("div")).parent().children(".form-item").slideToggle();
        $(e.target.closest("div")).parent().toggleClass("metabox-close");
    })



if($("admin-delete-modal")){
    $("body").on("click",".admin-table-actions-delete",function (e) {
        e.preventDefault();
        var link=e.target.closest("a").getAttribute("href");
        if(e.target.closest("a").classList.contains("admin-media-item-delete")){
                if(confirm("از حذف این آیتم اطمینان دارید")){
                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery("meta[name='token']").attr("content")
                        }
                    });
                    jQuery.ajax({
                        type:"POST",
                        url:link,
                        data:{
                            "_method":"DELETE"
                        },
                        success:function (data) {
                            toastMessage("رسانه با موفقیت حذف شد")
                            e.target.closest(".admin-frame-item").remove();
                        },
                        error:function (){
                            toastMessage("مشکلی رخ داده است لطفا دوباره امتحان کنید","ارور","error","red")
                        }
                    });
                }
        }else {
            $(".admin-delete-modal form").attr("action", link);
            document.querySelector(".admin-delete-modal").style.cssText = "left:50%"
        }
    });
    $(".admin-modal-close").click(function () {
        document.querySelector(".admin-delete-modal").style.cssText="left:-105vw"
    })
}

if($(".admin-media-item")){
    $(".admin-media-item").click(function (e) {
        var item=e.target.closest("div").dataset.link;

    })
}

if($(".admin-frame-media-select")){
    $(".admin-frame-media-select-center img").click(function(e){
        var img =e.target.dataset.url;

    })

    if($(".admin-select-all-checkbox-btn")){
        $(".admin-select-all-checkbox-btn").click(function(e){
            var checked= e.target.checked;
            if(checked && $("table input[type=checkbox]")){
               $("table input[type=checkbox]").prop( "checked", true );
            } else{
                 $("table input[type=checkbox]").prop( "checked", false );
            }
        })

    }
if($(".add-menu-box-open-btn")){
    $(".add-menu-boxs ul").click(function(e){
        if(e.target.closest("div").classList.contains("add-menu-box-open-btn")) {
            $(e.target.closest("li")).children(".add-menu-box-bottom-content").slideToggle(500);
        }
    })

}
if($(".add-menu-boxs ul")){
   Sortable.create(document.querySelector(".add-menu-boxs ul"),{
        animation: 150,
        ghostClass: 'blue-background-class',
        swapThreshold: 1,
        invertSwap: true,
    })



}
if($(".menu-add-item-box")){
    $(".menu-add-item-box").click(function (e) {
        e.preventDefault();
        var checked=Array.from(document.querySelectorAll(".menu-checkbox:checked"));
        var parentUl=document.querySelector(".add-menu-boxs ul");
        checked.forEach(e=>{
            var parent=e.closest("li");

            parentUl.insertAdjacentHTML("beforeend",`
            <li class="add-menu-box">
                        <div class="add-menu-box-bottom-top">
                            <div class="add-menu-box-name">
                                ${ parent.querySelector("label").textContent }
                            </div>
                            <div class="add-menu-box-open-btn">
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="add-menu-box-bottom-content">
                        <input type="hidden" name="menu_id[]" value="${ parent.querySelector(".menu-checkbox").value }">
                            <p class="form-row">
                                <label>نام :</label>
                                <input type="text" name="menu_name[]" class="menu-name-input" placeholder="نام" value=" ${ parent.querySelector("label").textContent }">
                            </p>
                            <p class="form-row">
                                <label>لینک :</label>
                                <input type="text" name="menu_link[]" placeholder="لینک" value="${ parent.querySelector(".menu-link").value }">
                            </p>
                            <div class="form-row">
                            <button class="btn btn-danger delete-admin-item btn-sm">حذف</button>
</div>
                        </div>
                    </li>
            `)
            $(".menu-checkbox").prop( "checked", false );
        })
    })
}
if($(".add-menu-box-bottom-content input[name=menu_name]")){
    $(".add-menu-boxs ul").keyup(function(e){
        if(e.target.closest("input").classList.contains("menu-name-input")) {
            e.target.closest("li").querySelector(".add-menu-box-name").textContent=e.target.closest("input").value
        }
    })
}
    if($(".delete-admin-item")){
        $(".add-menu-boxs ul").click(function(e){
            if(e.target.closest("button").classList.contains("delete-admin-item")) {
                e.target.closest("li").remove();
            }
        })
    }
}

});
