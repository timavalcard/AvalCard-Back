<?php

namespace CMS\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use CMS\Article\Models\Article;
use CMS\Article\Models\VipSubscription;
use CMS\Cart\Models\Cart;
use CMS\Cart\Models\CourseCart;
use CMS\Comment\Models\Comment;
use CMS\Course\Models\Course;
use CMS\Course\Models\CourseUser;
use CMS\Marketing\Repository\AffiliateRepository;
use CMS\Order\Models\Order;
use CMS\Product\Models\Coupon;
use CMS\Product\Models\Wishlist;
use CMS\RolePermissions\Models\Role;
use CMS\Settlement\Models\Settlement;
use CMS\Transaction\Models\Transaction;
use CMS\User\Notifications\DefaultMailNotification;
use CMS\User\Notifications\ResetPasswordRequestNotification;
use CMS\User\Notifications\VerifyMailNotification;
use CMS\User\Repositories\UserRepository;
use CMS\Wallet\Models\Wallet;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use HasRoles;
    const ACCOUNT_ACTIVE = "active";
    const ACCOUNT_BAN = "ban";
    const ACCOUNT_STATUSES=[self::ACCOUNT_ACTIVE,self::ACCOUNT_BAN];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','mobile', 'password','status','email_verified_at','mobile_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    public function article()
    {
        return $this->hasMany(Article::class);
    }
    public function settlement(){
        return $this->hasMany(Settlement::class);
    }
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function course_cart()
    {
        return $this->hasOne(CourseCart::class);
    }

      public function user_meta()
    {
        return $this->hasMany(User_meta::class, 'user_id',"id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function syncRoles(...$roles)
    {
        $this->roles()->detach();

        return $this->assignRole($roles);
    }
    public function bank_cart()
    {
        return $this->hasMany(UserBankCart::class);
    }
    public function address()
    {
        return $this->hasMany(User_address::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function courses()
    {
        return $this->hasMany(CourseUser::class);
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }


    public function coupon(){
        return $this->belongsToMany(Coupon::class,"user_coupon");
    }

    public function getProfileAvatarAttribute(){
        $profile_avatar_id=UserRepository::get_meta("profile_avatar",$this);
        if($profile_avatar_id) return asset(store_image_link($profile_avatar_id));

        return theme_asset("img/user_avatar.png") ;
    }
    public function getNationalCodeAttribute(){
        return UserRepository::get_meta("national_code",$this);
    }
    public function getAuthorizeAttribute(){
        return UserRepository::get_meta("authorize_status",$this);
    }
    public function getAuthorizeDeclineReasonAttribute(){
        return UserRepository::get_meta("authorize_decline_reason",$this);
    }
    public function getAuthorizeNameAttribute() {
        return UserRepository::get_meta('authorize_name', $this);
    }

    public function getAuthorizeLastNameAttribute() {
        return UserRepository::get_meta('authorize_last_name', $this);
    }

    public function getAuthorizeNationalCodeAttribute() {
        return UserRepository::get_meta('authorize_national_code', $this);
    }

    public function getAuthorizePhoneAttribute() {
        return UserRepository::get_meta('authorize_phone', $this);
    }

    public function getAuthorizeYearAttribute() {
        return UserRepository::get_meta('authorize_year', $this);
    }

    public function getAuthorizeMonthAttribute() {
        return UserRepository::get_meta('authorize_month', $this);
    }

    public function getAuthorizeDayAttribute() {
        return UserRepository::get_meta('authorize_day', $this);
    }

    public function getAuthorizeCityAttribute() {
        return UserRepository::get_meta('authorize_city', $this);
    }
    public function getAuthorizeStateAttribute() {
        return UserRepository::get_meta('authorize_state', $this);
    }
    public function getAuthorizePostalCodeAttribute() {
        return UserRepository::get_meta('authorize_postal_code', $this);
    }

    public function getAuthorizeStaticPhoneAttribute() {
        return UserRepository::get_meta('authorize_static_phone', $this);
    }

    public function getAuthorizeAddressAttribute() {
        return UserRepository::get_meta('authorize_address', $this);
    }
    public function getAuthorizeNationalCartImageAttribute(){
        $profile_avatar_id=UserRepository::get_meta("authorize_national_cart_image",$this);
        if($profile_avatar_id) return asset(store_image_link($profile_avatar_id));


    }
    public function getAuthorizeSelfImageAttribute(){
        $profile_avatar_id=UserRepository::get_meta("authorize_self_image",$this);
        if($profile_avatar_id) return asset(store_image_link($profile_avatar_id));


    }


    public function getMainAddressAttribute(){
        return UserRepository::get_meta("address",$this);
    }

    public function getCityAttribute(){
        return UserRepository::get_meta("city",$this);
    }
    public function getStateAttribute(){
        return UserRepository::get_meta("state",$this);
    }

    public function vipSubscription()
    {
        return $this->hasOne(VipSubscription::class);
    }

    public function scopeVerifiedMobile($query, $mobile)
    {
        if(isEmail($mobile)){
            return $query->where('email', $mobile)
                ->where('status','!=',self::ACCOUNT_BAN)
                ->where('email_verified_at', '!=', null);
        }
        return $query->where('mobile', $mobile)
            ->where('status','!=',self::ACCOUNT_BAN)
            ->where('mobile_verified_at', '!=', null);
    }

    public function scopeNotVerifiedMobile($query, $mobile)
    {
        if(isEmail($mobile)){
            return $query->where('email', $mobile)
                ->where('status','!=',self::ACCOUNT_BAN)
                //->where('email_verified_at', null)
                ;

        }
        return $query->where('mobile', $mobile)
            ->where('status','!=',self::ACCOUNT_BAN)
            //->where('mobile_verified_at', null)
            ;
    }


    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyMailNotification());
    }
    public function sendDefaultEmailNotification($content)
    {
        if($this->email ){

            $this->notify(new DefaultMailNotification($content));
        }

    }

    public function sendResetPasswordRequestNotification()
    {
        $this->notify(new ResetPasswordRequestNotification());
    }
    public function getEntranceAttribute(){
        if($this->hasRole(Role::ROLE_AFFILIATE)){
            return AffiliateRepository::get_affiliate_all_entrance($this->id);
        }
    }

}
