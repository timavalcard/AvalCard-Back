<?php

namespace API\User\Http\Controllers;

use API\User\Http\Resources\TransactionResource;
use API\User\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use CMS\Common\Services\CommonService;
use CMS\Order\Repository\OrderRepository;
use CMS\Shop\Repository\ShopRepository;
use CMS\Shop\Service\ShopService;
use CMS\User\Helpers\SmsForgotPasswordMethod;
use CMS\User\Helpers\SmsVerifyLoginMethod;
use CMS\User\Helpers\SmsVerifyMethod;
use CMS\User\Models\User;
use CMS\User\Models\User_address;
use CMS\User\Models\UserBankCart;
use CMS\User\Repositories\UserRepository;
use CMS\Wallet\Repository\WalletRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use CMS\Media\Services\MediaFileService;
use CMS\NewsletterEmail\Repository\NewsletterEmailRepository;
use CMS\RolePermissions\Models\Role;
use CMS\User\Services\VerifyCodeService;
use SanjabVerify\Support\Facades\Verify;


class UserController extends Controller
{
    use AuthenticatesUsers;
    public function checkLoginStatus(){
        if(request()->user()){

            if($user=UserRepository::find_by_mobile(request()->user()->mobile)){
                if($user->status == User::ACCOUNT_BAN){
                    request()->user()->logout();
                    return ["message"=>"Unauthenticated"];
                }else{
                    return new UserResource(request()->user());

                }
            }
        }
        request()->user();
    }

    public function register(Request $request)
    {
        if(isEmail($request->email)){
            $emailExists = User::query()->where('email', $request->email)->whereNull("email_verified_at")->first();
            if($emailExists){
                $emailExists->delete();
            }
            $user = User::create([
                'name' => $request->name,
                'email' =>  $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->sendEmailVerificationNotification();
        } else{
            $mobileExists = User::query()->where('mobile', $request->email)->whereNull("mobile_verified_at")->first();
            if($mobileExists){
                $mobileExists->delete();
            }
            $user = User::create([
                'name' => $request->name,
                'mobile' =>  $request->email,
                'password' => Hash::make($request->password),
            ]);
            $result = Verify::request($request->email, SmsVerifyMethod::class);
        }

        $user->assignRole(Role::ROLE_USER);
        return response()->json([
            "success"=>true
            //'access_token' => $token,
            //'token_type' => 'Bearer',
            // 'user' => new UserResource(auth()->user()),
        ]);
    }

    public function register_check_code(Request $request){
        if(isEmail($request->email)){
            $user=User::query()->where("email",$request->email)->first();
            if($user){
                if(VerifyCodeService::check($user->id,(int) $request->code)){
                    $credentials = $request->only('email', 'password');
                    $user->email_verified_at = now();
                    $user->save();
                    Auth::attempt($credentials);

                    $token = $user->createToken('authToken')->plainTextToken;
                    return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                        'user' => new UserResource($user),
                    ]);
                }


            }
        } else{
            $user=User::query()->where("mobile",$request->email)->first();
            if($user){
                $result = Verify::verify($request->email,(int)  $request->code);
                if ($result && $result['success'] == true){

                    $user->mobile_verified_at = now();
                    $user->save();
                    $login = auth()->attempt([
                        'mobile' => $request['email'],
                        'password' => $request['password'],
                    ]);
                    if($login){
                        $token = $user->createToken('authToken')->plainTextToken;
                        return response()->json([
                            'access_token' => $token,
                            'token_type' => 'Bearer',
                            'user' => new UserResource($user),
                        ]);
                    }

                }


            }
        }


        return false;
    }

    public function login(Request $request)
    {
        $user=UserRepository::get_user_by_email_or_mobile($request->mobile);
        if($user){
            if($user->status == User::ACCOUNT_BAN){
                return [
                    "fail"=>"حساب شما غیرفعال شده است. لطفا برای کسب اطلاعات بیشتر تماس بگیرید."
                ];
            }
        }


        if(isEmail($request->mobile)){
            $login = auth()->attempt([
                'email' => $request['mobile'],
                'password' => $request['password'],
            ]);
        } else{
            $login = auth()->attempt([
                'mobile' => $request['mobile'],
                'password' => $request['password'],
            ]);
        }
        if (!$login) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $token = auth()->user()->createToken('authToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource(auth()->user()),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();


        return $request->wantsJson()
            ? response()->json(['message' => 'Logged out successfully'])
            : redirect('/');
    }

    public function sendRegisterEmail(Request $request){

        if(isEmail($request->mobile)) {
            $user=User::query()->where("email",$request->mobile)->first();
            if($user){
                $user->sendEmailVerificationNotification();
                return true;

            }
        } else{
            $user=User::query()->where("mobile",$request->mobile)->first();
            if($user){
                $result = Verify::request($request->mobile, SmsVerifyMethod::class);
                return true;

            }
        }

        return false;
    }
    public function sendResetPasswordEmail(Request $request){

        if(isEmail($request->mobile)) {
            $user=User::query()->where("email",$request->mobile)->first();
            if($user){
                $user->sendResetPasswordRequestNotification();
                return true;

            }
        } else{
            $user=User::query()->where("mobile",$request->mobile)->first();
            if($user){
            $result = Verify::request($request->mobile, SmsForgotPasswordMethod::class);
            return true;

            }
        }

        return false;
    }


    public function loginSendCode(Request $request){

        if(isEmail($request->mobile)) {
            $user=User::query()->where("email",$request->mobile)->first();
            if($user){
                $user->sendEmailVerificationNotification();
                return true;

            }
        } else{
            $user=User::query()->where("mobile",$request->mobile)->first();
            if($user){
                $result = Verify::request($request->mobile, SmsVerifyLoginMethod::class);

                return true;

            }
        }

        return false;
    }
    public function loginCheckCode(Request $request){
        if(isEmail($request->email)){
            $user=User::query()->where("email",$request->email)->first();
            if($user){
                if(VerifyCodeService::check($user->id,(int) $request->code)){
                    Auth::login($user);

                    $token = $user->createToken('authToken')->plainTextToken;
                    return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                        'user' => new UserResource($user),
                    ]);
                }


            }
        } else{
            $user=User::query()->where("mobile",$request->email)->first();
            if($user){
                $result = Verify::verify($request->email,(int)  $request->code);

                if ($result && $result['success'] == true){


                    $login = Auth::login($user);

                        $token = $user->createToken('authToken')->plainTextToken;
                        return response()->json([
                            'access_token' => $token,
                            'token_type' => 'Bearer',
                            'user' => new UserResource($user),
                        ]);


                }


            }
        }


        return false;
    }

    public function ResetPasswordCheckCode(Request $request){

        if(isEmail($request->mobile)) {
            $user=User::query()->where("email",$request->mobile)->first();
            if($user){

                if($valid=VerifyCodeService::check($user->id, $request->code)){
                    $user->password = bcrypt($request->password);
                    $user->save();
                }

                return  response()->json(['valid' => $valid]);

            }
        } else{
            $user=User::query()->where("mobile",$request->mobile)->first();
            if($user){
                if($valid=Verify::verify($request->mobile,(int)  $request->code)){
                    $user->password = bcrypt($request->password);
                    $user->save();
                }

                return  response()->json(['valid' => $valid]);
            }
        }



        return false;
    }

    public function updatePassword(Request $request){
        $user=User::query()->where("mobile",$request->mobile)->first();
        if($user){
            $user->password = bcrypt($request->password);
            $user->save();
            return true;
        }


    }

    public function checkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        if(isEmail($request->email)){
            $emailExists = User::query()->where('email', $request->email)->exists();
            return response()->json(['exists' => $emailExists]);
        } else{
        $emailExists = User::query()->where('mobile', $request->email)->whereNotNull("mobile_verified_at")->exists();
        return response()->json(['exists' => $emailExists]);

        }

    }

    public function checkEmailOrPhone(Request $request)
    {
       if(isEmail($request->email)){
           $emailExists = User::query()->where('email', $request->email)->whereNotNull("email_verified_at")->exists();

       } else{
           $emailExists = User::query()->where('mobile', $request->email)->whereNotNull("mobile_verified_at")->exists();

       }


        return response()->json(['exists' => $emailExists]);
    }


    public function updateProfile(){
        $data = \request()->data;

        $user=request()->user();
        if($user){
            if(isset($data["name"])){
                $user->name = $data["name"];
                UserRepository::add_meta([["name"=>"last_name","value"=>$data["last_name"]]],$user);

            }
            if(isset($data["birthday"])){

                UserRepository::add_meta([["name"=>"birthday","value"=>$data["birthday"]]],$user);

            }
            if(isset($data["email"])){
                /* if(VerifyCodeService::check($user->id,(int) \request()->code)){
                     return response()->json(['valid' => false]);
                 } else{
                     $user->email = $data["email"];
                 }*/

                $user->email = $data["email"];

            } if(isset($data["new_password"])){
                if(Hash::check($data["current_password"], $user->password)){
                    $user->password = bcrypt($data["new_password"]);
                } else{
                    return response()->json(['failed' =>'Şifre yanlış']);
                }


            }

            $user->save();
            return new UserResource($user);
        }
        return false;
    }

    public function changeEmailSendCode(Request $request){
        $user=User::query()->where("email",$request->user_email)->first();
        if($user){
            $user->sendChangeEmailNotification($request->new_email);
        }
    }
    public function changeEmailCheckCode(Request $request){
        $user=User::query()->where("email",$request->email)->first();
        if($user){
            return response()->json(['valid' => VerifyCodeService::check($user->id,(int) $request->code)]);

        }
        return false;
    }

    public function changeNewsletter(){
        $user=request()->user();
        $status=\request()->status;

        $newsletter=NewsletterEmailRepository::find_by_email($user->email);

        if($newsletter){
            $newsletter->status = $status;
            $newsletter->save();
        } else {
            NewsletterEmailRepository::create([
                "email" => $user->email,
                "user_id" => $user->id,
                "status" => $user->$status,
            ]);
        }

    }

    public function getNewsletter(){
        $user=request()->user();

        $newsletter=NewsletterEmailRepository::find_by_email($user->email);

        if($newsletter){
            return $newsletter->status;
        }
        return "off";

    }


    public function upload_profile(){
        $user=request()->user();

        if($user) {
            $image = \request()->file('image');
            $image = MediaFileService::privateUpload($image);
            UserRepository::add_meta([["name" => "profile_avatar", "value" => $image->id]],$user);
            return new UserResource($user);
        }
    }
    public function delete_profile(){
        $user=request()->user();

        if($user) {

            UserRepository::delete_meta("profile_avatar",$user);
            return new UserResource($user);
        }
    }

    public function add_newsletter(Request $request){
        if($request->email){

            auth()->check() ? $request->request->add(["user_id"=>auth()->id()]) : $request->request->add(["user_id"=>0]) ;
            NewsletterEmailRepository::create($request->all());
        }
        return response()->json(['success' => 'عملیات موفقیت آمیز بود.'], 200);
    }

    public function wallet_transactions(){
        $user=request()->user();
        $transactions=$user->transactions()->where("transactionable_type","wallet")->orderByDesc("created_at")->get();

        return TransactionResource::collection($transactions);
    }

    public function increase_wallet(){
        $wallet=WalletRepository::create_wallet(0,request()->user());
        $amount=(integer) request()->price;
        $gateway_name=ShopRepository::get_first_gateway();

        return ShopService::send_to_gateway($gateway_name,$amount,$wallet);
    }


    public function update_password(Request $request){
        $user=request()->user();
        if (Hash::check($request->beforePassword, $user->password)) {
            $user->password= Hash::make($request->password);
            $user->save();
            return true;
        } else {
            return response()->json([
                "fail"=>true
            ]);
        }



    }

    public function update_profile(Request $request){
        $user=request()->user();
        if (!empty($request->fullName)) {
            $user->name = $request->fullName;
        }

        if (!empty($request->phone)) {
            $user->mobile = $request->phone;
        }

        if (!empty($request->email)) {
            $user->email = $request->email;
        }

        if (!empty($request->province)) {
            UserRepository::add_meta([["name" => "state", "value" => $request->province]], $user);
        }

        if (!empty($request->city)) {
            UserRepository::add_meta([["name" => "city", "value" => $request->city]], $user);
        }

        if (!empty($request->nationalCode)) {
            UserRepository::add_meta([["name" => "national_code", "value" => $request->nationalCode]], $user);
        }

        if (!empty($request->address)) {
            UserRepository::add_meta([["name" => "address", "value" => $request->address]], $user);
        }

        if (!empty($request->file)) {
            $image = MediaFileService::publicUpload($request->file);
            UserRepository::add_meta([["name" => "profile_avatar", "value" => $image->id]], $user);
        }


        $user->save();
        return new UserResource($user);

    }

    public function add_address(Request $request){
        $user=request()->user();

        User_address::create([
            'user_id'=>$user->id,
            'title'=>$request->title,
            'phone'=>$request->phone,
            'postal_code'=>$request->postalCode,
            'address'=>$request->address,
            'state'=>$request->province,
            'city'=>$request->city,
        ]);

        return new UserResource($user);


    }
    public function update_address(Request $request){
        $user=request()->user();
        $address=User_address::find($request->address_id);
        if($address->user_id == $user->id){
            $address->update([
                'title'=>$request->title,
                'phone'=>$request->phone,
                'postal_code'=>$request->postalCode,
                'address'=>$request->address,
                'state'=>$request->province,
                'city'=>$request->city,
            ]);
        }


        return new UserResource($user);

    }
    public function delete_address(Request $request){
        $user=request()->user();
        $address=User_address::find($request->address_id);
        if($address->user_id == $user->id){
            $address->delete();
        }
        return new UserResource($user);
    }
    public function add_bank_cart(Request $request){
        $user=request()->user();

        UserBankCart::create([
            'user_id'=>$user->id,
            'bank_name'=>$request->cart["en"],
            'bank_name_fa'=>$request->cart["fa"],
            'cart_number'=>$request->cardNumber,
            'shaba_number'=>$request->sheba,
        ]);

        return new UserResource($user);


    }
    public function update_bank_cart(Request $request){
        $user=request()->user();

        $bankCart=UserBankCart::find($request->bank_cart_id);
        if($bankCart->user_id == $user->id){
            $bankCart->update([
                //todo
                'bank_name'=>"صادرات",
                'cart_number'=>$request->cardNumber,
                'shaba_number'=>$request->sheba,
            ]);
        }

        return new UserResource($user);

    }
    public function delete_bank_cart(Request $request){
        $user=request()->user();

        $bankCart=UserBankCart::find($request->bank_cart_id);
        if($bankCart->user_id == $user->id) {
         $bankCart->delete();
        }

        return new UserResource($user);
    }

    public function add_authorize(Request $request){
        $user=request()->user();

        $metas = [
            ["name" => "authorize_status", "value" => "pending"],
            ["name" => "authorize_name", "value" => $request->firstName],
            ["name" => "authorize_last_name", "value" => $request->lastName],
            ["name" => "authorize_national_code", "value" => $request->nationalCode],
            ["name" => "authorize_phone", "value" => $request->mobile],
            ["name" => "authorize_year", "value" => $request->birthYear],
            ["name" => "authorize_month", "value" => $request->birthMonth],
            ["name" => "authorize_day", "value" => $request->birthDay],
            ["name" => "authorize_city", "value" => $request->city],
            ["name" => "authorize_state", "value" => $request->province],
            ["name" => "authorize_postal_code", "value" => $request->postalCode],
            ["name" => "authorize_static_phone", "value" => $request->phone],
            ["name" => "authorize_address", "value" => $request->address],
        ];

        UserRepository::add_meta($metas, $user);



        if (!empty($request->authorize_self_image)) {
            $image = MediaFileService::publicUpload($request->authorize_self_image);
            UserRepository::add_meta([["name" => "authorize_self_image", "value" => $image->id]], $user);
        }
        if (!empty($request->authorize_national_cart_image)) {
            $image = MediaFileService::publicUpload($request->authorize_national_cart_image);
            UserRepository::add_meta([["name" => "authorize_national_cart_image", "value" => $image->id]], $user);
        }
        CommonService::tel_bot("authorize",$user->name);
        return new UserResource($user);
    }


}










