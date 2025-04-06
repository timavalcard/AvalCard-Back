<?php

namespace CMS\User\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use CMS\Common\Services\CommonService;
use CMS\RolePermissions\Models\Permission;
use CMS\RolePermissions\Models\Role;
use CMS\User\Helpers\SmsForgotPasswordMethod;
use CMS\User\Helpers\SmsVerifyMethod;
use App\Http\Controllers\Controller;
use CMS\User\Http\Requests\Auth\check_code_request;
use CMS\User\Http\Requests\Auth\check_exists_and_status_request;
use CMS\User\Http\Requests\Auth\forgot_password_check_code_request;
use CMS\User\Http\Requests\Auth\forgot_password_send_request;
use CMS\User\Http\Requests\Auth\login_request;
use CMS\User\Http\Requests\Auth\register_request;
use CMS\User\Http\Requests\Auth\set_user_name_request;
use CMS\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use CMS\User\Repositories\UserRepository;
use CMS\User\Services\VerifyCodeService;
use SanjabVerify\Support\Facades\Verify;

class AuthController extends Controller
{

    public function __construct()
    {
        $middlewares=['logout','check_login',"set_user_name"];
        if(isset(\request()->affiliate)){
            $middlewares[]="index";
        }
        $this->middleware('guest')->except($middlewares);
    }

    public function index()
    {

        $affiliate=false;
        if(isset(\request()->affiliate)){
            if(\auth()->check()){
                if(auth()->user()->hasRole(\CMS\RolePermissions\Models\Role::ROLE_AFFILIATE)){
                    return redirect()->route("affiliate.index");
                }
                Auth::logout();
            }
            $affiliate=true;
        }
        return view('User::Front.auth',compact('affiliate'));
    }

    public function check_exists_and_status(check_exists_and_status_request $request)
    {
        $mobile = $request->mobile;

        $user = User::query()
            ->verifiedMobile($mobile)
            ->first();

        //in mpa component use session for auth forms placeholder but in spa component return mobile to json format
//        session()->put('mobile_session', $mobile);

        if ($user && $user instanceof User) {
            return response()->json([
                'message' => 'before registered and active account',
            ],'200');
        } else {

            if(isEmail($mobile)){
                return response()->json([
                    'message' => 'not registered by email',
                ],'200');
            } else{
                return response()->json([
                    'message' => 'not registered or not active account',
                ],'200');
            }

        }

    }

    public function register(register_request $request)
    {
        $mobile = $request->mobile;

        $user = User::query()
            ->VerifiedMobile($mobile)
            ->first();

        if ($user && $user instanceof User) {
            return 'before registered and active account';
        } else {
            $userExistsButNotVerified = User::query()
                ->notVerifiedMobile($mobile)
                ->first();

            if ($userExistsButNotVerified &&
                $userExistsButNotVerified instanceof User
            ) {
                $userExistsButNotVerified->update([
                    'password' => Hash::make($request->password),
                ]);
                $status = 'registered before but not active';

                if(isEmail($mobile)){
                    $userExistsButNotVerified->sendEmailVerificationNotification();
                    return response()->json([
                        'status' => 'send code successfully',
                        'message' => 'کد با موفقیت ارسال شد'
                    ],200);
                } else {
                    $result = Verify::request($mobile, SmsVerifyMethod::class);
                    if ($result['success'] == 200) {
                        return response()->json([
                            'status' => 'send code successfully',
                            'message' => 'کد با موفقیت ارسال شد'
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 'error to send code',
                            'message' => $result
                        ], 400);
                    }
                }

            } else {
                if(isEmail($mobile)){
                    $user=User::create([
                        'email' => $mobile,
                        'name' => $request->name,
                    ]);
                    UserRepository::add_meta([
                        ["name"=>"lastname","value"=>$request->lastname],
                        ["name"=>"national_code","value"=>$request->national_code],
                    ],$user);
                    //Auth::loginUsingId($user->id);
                    //Auth::user()->assignRole(Role::ROLE_USER);
                    $user->sendEmailVerificationNotification();
                    return response()->json([
                        'status' => 'send code successfully',
                        'message' => 'کد با موفقیت ارسال شد'
                    ],200);
                } else{
                    $user=User::query()->create([
                        'mobile' => $mobile,
                        'name' => $request->name,
                    ]);
                    UserRepository::add_meta([
                        ["name"=>"lastname","value"=>$request->lastname],
                        ["name"=>"national_code","value"=>$request->national_code],
                    ],$user);
                    $result = Verify::request($mobile, SmsVerifyMethod::class);
                    if ($result['success'] == 200) {
                        return response()->json([
                            'status' => 'send code successfully',
                            'message' => 'کد با موفقیت ارسال شد'
                        ],200);
                    } else {
                        return response()->json([
                            'status' => 'error to send code',
                            'message' => $result
                        ],400);
                    }
                }

                $status = 'never registered but now register first time';
            }
            //send verification code
        }
        return response()->json([
            'status' => 'send code successfully',
            'message' => 'send code successfully'
        ],200);

    }


    public function login_code(Request $request){
        $mobile = $request->mobile;

        if(!isEmail($mobile)){
            $result = Verify::request($mobile, SmsVerifyMethod::class);
            if ($result['success'] == 200) {
                return response()->json([
                    'status' => 'send code successfully',
                    'message' => 'کد با موفقیت ارسال شد'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error to send code',
                    'message' => $result
                ], 400);
            }
        }
    }

    public function check_login_code(check_code_request $request)
    {
        $mobile = $request->mobile;



            $userExistsButNotVerified = User::query()
                ->VerifiedMobile($mobile)
                ->first();

            if ($userExistsButNotVerified && $userExistsButNotVerified instanceof User) {
                // verify verification code

                $result['success'] = true;
                $status = 'working on verify code';
            } else {
                $result['success'] = false;
            }

            if ($result &&
                $result['success'] == true &&
                $userExistsButNotVerified &&
                $userExistsButNotVerified instanceof User
            ) {

                if(!isEmail($mobile)){
                $result = Verify::verify($request->mobile, $request->code);
                    if ($result && $result['success'] == true) {

                        Auth::login($userExistsButNotVerified);
                        return response()->json([
                            'status' => 'success',
                            'message' => 'کد وارد شده صحیح بود',
                            'url' => route("user.account"),
                            'address' => null
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 'failed',
                            'message' => 'کد وارد شده صحیح نیست'
                        ], 400);
                    }

            }

            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'کد وارد شده صحیح نیست'
                ],400);
            }

    }

    public function check_code(check_code_request $request)
    {
        $mobile = $request->mobile;

        $user = User::query()
            ->VerifiedMobile($mobile)
            ->first();

        if ($user && $user instanceof User) {
            return response()->json([
                'status' => 'failed',
                'message' => 'قبلا ثبت نام کرده اید'
            ],400);
        } else {

            $userExistsButNotVerified = User::query()
                ->notVerifiedMobile($mobile)
                ->first();

            if ($userExistsButNotVerified && $userExistsButNotVerified instanceof User) {
                // verify verification code

                $result['success'] = true;
                $status = 'working on verify code';
            } else {
                $result['success'] = false;
            }

            if ($result &&
                $result['success'] == true &&
                $userExistsButNotVerified &&
                $userExistsButNotVerified instanceof User
            ) {

                if(is_null($userExistsButNotVerified->email)){
                    $result = Verify::verify($request->mobile, $request->code);
                    if ($result && $result['success'] == true){
                        $userExistsButNotVerified->update([
                            'mobile_verified_at' => time(),
                        ]);
                        //Auth::loginUsingId($userExistsButNotVerified->id);
                        Auth::login($userExistsButNotVerified);
                        if(isset($request->affiliate) && $request->affiliate=="true"){
                            Auth::user()->assignRole(Role::ROLE_AFFILIATE_NEED_AUTHORIZE);
                            toastMessage("ثبت نام انجام شد لطفا منتظر احراز هویت بمانید.");

                        } else{
                            Auth::user()->assignRole(Role::ROLE_USER);
                        }
                        CommonService::tel_bot("user_add",Auth::user()->id);
                        return response()->json( [
                            'status' => 'success',
                            'message' =>'کد وارد شده صحیح بود',
                            'url' => route("user.account"),
                            'address' => null
                        ],200);
                    } else {
                        return response()->json([
                            'status' => 'failed',
                            'message' => 'کد وارد شده صحیح نیست'
                        ],400);
                    }


                } else{

                    if(VerifyCodeService::check($userExistsButNotVerified->id, $request->code)){
                    //if(true){
                        $userExistsButNotVerified->update([
                            'email_verified_at' => time(),
                        ]);
                        //Auth::loginUsingId($userExistsButNotVerified->id);
                        Auth::login($userExistsButNotVerified);
                        if(isset($request->affiliate) && $request->affiliate=="true"){
                            Auth::user()->assignRole(Role::ROLE_AFFILIATE_NEED_AUTHORIZE);
                            toastMessage("ثبت نام انجام شد لطفا منتظر احراز هویت بمانید.");

                        } else{
                            Auth::user()->assignRole(Role::ROLE_USER);
                        }
                        CommonService::tel_bot("user_add",Auth::user()->id);
                        return response()->json( [
                            'status' => 'success',
                            'message' =>'کد وارد شده صحیح بود',
                            'url' => URL::previous(),
                            'address' => null
                        ],200);
                    } else{
                        return response()->json([
                            'status' => 'failed',
                            'message' => 'کد وارد شده صحیح نیست'
                        ],400);
                    }

                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'کد وارد شده صحیح نیست'
                ],400);
            }
        }
    }

    public function forgot_password_send(forgot_password_send_request $request)
    {
        $mobile = $request->mobile;

        $user = User::query()->VerifiedMobile($mobile)
            ->first();

        if ($user && $user instanceof User) {

            //send code
            if(isEmail($mobile)){
                $user->sendEmailVerificationNotification();
                $result['success'] = true;
                $result['message'] = "message";
                return response()->json([
                    'status' => 'success',
                    'message' => $result['message']
                ],200);
            } else{
                $result = Verify::request($mobile, SmsForgotPasswordMethod::class);
                if ($result['success'] == 200) {
                    return response()->json([
                        'status' => 'success',
                        'message' => $result['message']
                    ],200);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => $result['message']
                    ],400);
                }
            }



        } else {
            return response('before registered but account never active',400);
        }

    }

    public function forgot_password_check_code(forgot_password_check_code_request $request)
    {
        $mobile = $request->mobile;

        $user = User::query()->verifiedMobile($mobile)->first();

        if ($user && $user instanceof User) {
            if(isEmail($mobile)){
                if(VerifyCodeService::check($user->id, $request->code)){
                    $user->update([
                        'password' => bcrypt($request->password),
                    ]);

                    Auth::login($user, true);

                    Cache::forget($mobile . 'forgetPass');

                    Auth::logoutOtherDevices($request->password);

                    if (!$user->hasRole(Role::ROLE_USER)){ $url = route("admin.dashboard"); } else { $url = URL::previous();}

                    return response()->json([
                        'status' => 'success',
                        'message' => 'رمز عبور تغییر یافت',
                        'url' => $url,
                        'address' => $user->address
                    ],200);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'اطلاعات ورودی صحیح نیست'
                    ],400);
                }
            } else{
                if (Cache::get($mobile . 'forgetPass') == $request->code) {

                    $user->update([
                        'password' => bcrypt($request->password),
                    ]);

                    Auth::login($user, true);

                    Cache::forget($mobile . 'forgetPass');

                    Auth::logoutOtherDevices($request->password);

                    if (!$user->hasRole(Role::ROLE_USER)){ $url = route("admin.dashboard"); } else { $url = URL::previous();}

                    return response()->json([
                        'status' => 'success',
                        'message' => 'رمز عبور تغییر یافت',
                        'url' => $url,
                        'address' => $user->address
                    ],200);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'اطلاعات ورودی صحیح نیست'
                    ],400);
                }
            }

        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'دسترسی به این بخش ندارید'
            ],400);
        }

    }

    public function login_user(login_request $request)
    {
        $mobile = $request->mobile;
        $user = User::query()
            ->verifiedMobile($mobile)
            ->first();

        if (
            $user &&
            $user instanceof User
        ) {
//            Auth::logoutOtherDevices($request->password);
            if(isEmail($request['mobile'])){
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
            if ($login){
                Auth::login($user);
                if (!$user->hasRole(Role::ROLE_USER)){
                    $url = route("admin.dashboard"); }
                else { $url = URL::previous();}
                if ($user->hasRole(Role::ROLE_AFFILIATE)){
                    $url = route("affiliate.index");
                }
                if($user->hasRole(Role::ROLE_AFFILIATE_NEED_AUTHORIZE)){
                     $url = URL::previous();
                }




                return response()->json([
                    'status' => 'success',
                    'message' => 'logged in',
                    'url' => $url,
                    'address' => $user->address
                ],200);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'رمز عبور وارد شده نادرست است!'
                ],400);
            }
        }
    }

    public function logout()
    {
        Auth::logout() ;
        return redirect()->route('home') ;

    }

}








