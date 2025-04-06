<?php

namespace API\User\Http\Controllers;

use API\User\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use CMS\User\Helpers\SmsVerifyMethod;
use CMS\User\Models\User;
use CMS\User\Repositories\UserRepository;
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


    public function sendResetPasswordEmail(Request $request){
        $user=User::query()->where("email",$request->email)->first();
        if($user){
            $user->sendResetPasswordRequestNotification();
        }
    }



    public function ResetPasswordCheckCode(Request $request){
        $user=User::query()->where("email",$request->email)->first();

        if($user){
            return response()->json(['valid' => VerifyCodeService::check($user->id,(int) $request->code)]);

        }
        return false;
    }

    public function updatePassword(Request $request){
        $user=User::query()->where("email",$request->email)->first();
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

        $emailExists = User::query()->where('mobile', $request->email)->whereNotNull("mobile_verified_at")->exists();

        return response()->json(['exists' => $emailExists]);
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
}










