<?php

use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use CMS\Comment\Repository\CommentRepository;
use CMS\Forms\Repository\FormsRepository;
use CMS\Media\Models\Media;
use CMS\ThemeSetting\Repository\ThemeSettingRepository;
use CMS\User\Models\User;


function get_information_for_admin_panel_route_group(): array
{
    return ["prefix" => "admin", "middleware" => ["web","auth","DashboardAdminMiddleware"]];
}

function get_information_for_front_panel_route_group(): array
{
    return ["prefix" => "panel", "middleware" => ["web"]];
}
function get_information_for_api_route_group(): array
{
    return ["prefix" => "api", "middleware" => ["api"]];
}
function get_guard(): ?string
{
    if (!Route::current()) {
        return null;
    }

    //Check if guard was set in route group
    $guard = Route::current()->getAction('guard');
    if ($guard) {
        return $guard;
    }

    //Get guard from subdomain (common used routes)
    $guards = [
//        env('NAME_SUBDOMAIN', 'name') => 'name',
    ];
    $subdomain = Route::current()->parameter('subdomain', null);
    if ($subdomain && isset($guards[$subdomain])) {
        $guard = $guards[$subdomain];
    }

    return $guard;
}

function rand_string($length = 8)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345678998765";
    return substr(str_shuffle($chars), 0, $length);
}

function updated($check, $routeName = "back",$route_params = [], $status = "updated")
{
    if ($routeName == "back") {
        if ($check) {
            return redirect()->back()->with('status', $status);
        } else {
            return redirect()->back()->with('status', $status);
        }
    } else {
        if ($check) {
            return redirect()->route($routeName,$route_params)->with('status', $status);
        } else {
            return redirect()->route($routeName,$route_params)->with('status', $status);
        }
    }
}

function created($check, $routeName = "back",$route_params = [], $status = "created")
{
    if ($routeName == "back") {
        if ($check) {
            return redirect()->back()->with('status', $status);
        } else {
            return redirect()->back()->with('status', $status);
        }
    } else {
        if ($check) {
            return redirect()->route($routeName,$route_params)->with('status', $status);
        } else {
            return redirect()->route($routeName,$route_params)->with('status', $status);
        }
    }
}

function error($routeName = "back", $status = "failed")
{
    if ($routeName == "back") {
        return redirect()->back()->with('status', $status);
    } else {
        return redirect()->route($routeName)->with('status', $status);
    }
}

function generateCode(){
    $salt = auth()->id() * 1;
    return $salt.substr(time(),-10+strlen($salt));
}

function reportOrder(string $message = 'گزارش سفارش',array $id_watchers = [],string $type =null){
    return [
        time() =>[
            'message' => $message,
            'type' => $type,
            "id_watchers" => $id_watchers
        ],
    ];
}

function IR_TimestampToDate($timestamp,$format= 'H:i Y-n-j'){
    return  $timestamp;
}

function IR_to_GR($data,$format= 'H:i Y-n-j'){
    $explode = explode('-',$data);
    return implode('-',verta()->getGregorian($explode[0],$explode[1],$explode[2]));
}



function get_user_meta($id,$meta_name){
    if(is_object($id)){
        if(get_class($id) ==User::class){
            $user=$id;
        }
    }
    else if(is_int($id)){
        $user=User::find($id);
    }
    if($user){
        return $user->user_meta()->where("meta_key",$meta_name)->first();
    }
    return false;
}

function update_user_meta($id,$meta_name,$meta_value){
    if(is_object($id)){
        if(get_class($id) ==User::class){
            $user=$id;
        }
    }
    else if(is_int($id)){
        $user=User::find($id);
    }
    if($user){
        $meta=$user->user_meta()->updateOrCreate(["meta_key"=>$meta_name], ["meta_value"=>$meta_value]);
        return $meta;
    }
    return false;
}





function get_post_meta($id,$meta_name,$type=null){
    if(is_object($id)){

        $post=$id;

    }
    else if(is_int($id) && $type){
        $post=$type::find($id);
    }

    if($post){
        return $post->post_meta()->where("meta_key",$meta_name)->first();
    }
    return false;
}

function update_post_meta($id,$meta_name,$meta_value,$type=null){
    if(is_object($id)) $post=$id;
    else if(is_int($id) && $type)$post=$type::find($id);

    if($post){
        $meta=$post->post_meta()->updateOrCreate(["meta_key"=>$meta_name],["meta_value"=>$meta_value]);
        return $meta;
    }

    return false;

}



function store_image_link($media=null,$size="original"){
    if (is_object($media)) return $media->url;
    if (is_numeric($media)){
        $media=Media::find($media);
        if($media)
            return $media->getUrlAttribute($size);
    }
    return "/storage";
}


function make_slug_for_data($title,$slug=null){
    if($slug==null){

        $slug=Str::slug($title,"-","");
    } else {
        $slug=Str::slug($slug,"-","");
    }
    return $slug;
}

function get_all_file_in_public(){
    $files=\File::allFiles(public_path(env('IMG_DIR','images')));
    if(!$files) return [];
    return $files ;
}




function get_comment_unApproved_count(){
    return CommentRepository::get_unAprove_coment_count();
}


function theme_option($key){
    ThemeSettingRepository::getOption($key);
}

function format_price_number($price){
    return number_format($price);
}

function format_price_with_currencySymbol($price, $symbol = "irr") {
    // تعریف آرایه‌ای از نمادهای ارزها
    $currencySymbols = [
        "irr" => "تومان", // تومان ایران
        "usd" => "$",  // دلار آمریکا
        "eur" => "€",  // یورو
        "gbp" => "£",  // پوند انگلیس
        "jpy" => "¥",  // ین ژاپن
        "cny" => "¥",  // یوان چین
        "inr" => "₹",  // روپیه هند
        // می‌توانید ارزهای دیگری را نیز اضافه کنید
    ];

    // اگر نماد ارز موجود در آرایه نیست، از نماد پیش‌فرض استفاده کن
    $currencySymbol = isset($currencySymbols[$symbol]) ? $currencySymbols[$symbol] : '';

    // بازگشت قیمت با نماد ارز
    return format_price_number($price)." ".$currencySymbol;
}


function theme_asset($path){
    return asset("theme/".$path);


}


function toastMessage($message="عملیات موفقیت امیز بود",$heading="عملیات موفقیت آمیز",$type="success"){
    session()->put("toast_message",$message);
    session()->put("toast_heading",$heading);
    session()->put("toast_type",$type);
}


function get_site_title(){
    if(ThemeSettingRepository::getOption("site_name")){
        return ThemeSettingRepository::getOption("site_name")[0]["site_name"];

    }
}
function get_site_description(){
    if(ThemeSettingRepository::getOption("site_des")){

        return ThemeSettingRepository::getOption("site_des")[0]["site_description"];
    }
}

function substrwords($text, $maxchar, $end='...') {
    if($text){
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                }
                else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        }
        else {
            $output = $text;
        }
        return $output;
    }

}


function isEmail($email) {

    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function toShamsi($date,$format='Y/m/d'){
    return \Morilog\Jalali\Jalalian::forge($date)->format($format);
}


function getBetween($string, $start = "", $end = ""){
    if (strpos($string, $start)) { // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return '';
    }
}
function add_shortcode_to_content($content){
    if ($short_code_content=getBetween($content,"[form ","]")) {

        $form_id=explode('&quot;',$short_code_content)[1];
        $form=FormsRepository::findNotFail($form_id);
        if($form){
            $route=route("form_add_entrance");
            $token=csrf_token();
            $formFields=$form->fields;
            $formAction=route('form_add_entrance');
            $link=theme_asset("js/formbuilder.js");
            $formContent=<<<HTML
<div class="form-wrapper"></div>
            <script src="$link"></script>

 <script>
            jQuery($ => {

                 const formData =JSON.stringify($formFields);
                // Grab markup and escape it
                const markup = $(".form-wrapper");
                markup.formRender({ formData, });
                var form_html=markup.formRender("html")
                form_html="<form class='hermes_form' action='$formAction' method='post'>" +form_html+"</form>"
                markup.html(form_html)

                jQuery(".hermes_form").submit(function (e){
                    e.preventDefault();
                    var form=jQuery(this)
                    jQuery.post({
                            url: "$route",
                            data: {
                                data:markup.formRender('userData'),
                                _token:"$token"
                            },
                            success: function (data){
                                alert("فرم ارسالی شما با موفقیت دریافت شد")
                            },

                        }
                    )
                })
            });
        </script>
HTML;
            $content=str_replace("[form $short_code_content]",$formContent,$content);
        }
    }

    if ($short_code_content=getBetween($content,"[form_entrance ","]")) {

        $form_id=explode('&quot;',$short_code_content)[1];
        $form=FormsRepository::findNotFail($form_id);
        $privateLabel=["شماره تماس","شماره تلفن ثابت"];
        if($form){
            $entrances=FormsRepository::accepted_entrances($form);
            $formContent='<div class="form_entrances_box">';
            foreach($entrances as $entrance) {
                $index=0;

                $formContent.='<div class="form_entrances_item" >';
                foreach ($entrance->values as $value) {

                    if ($index != 0 && $index != count($entrance->values) - 1 && (!in_array(strip_tags($value["label"]),$privateLabel))){
                        $formContent.='<div class="billing_information_item" >';
                        $formContent.='<div class="billing_information_item_title" >';
                        $formContent.=strip_tags($value["label"])??"";
                        $formContent.=' : </div>';
                        $formContent.='<div class="billing_information_item_value" >';
                        $formContent.=$value["userData"][0]??"";
                        $formContent.='</div>';
                        $formContent.='</div>';
                    }
                    $index++;
                }
                $formContent.='</div >';
            }
            $content=str_replace("[form_entrance $short_code_content]",$formContent,$content);
        }
    }

    return $content;
}
