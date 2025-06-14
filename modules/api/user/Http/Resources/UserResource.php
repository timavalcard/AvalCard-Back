<?php


namespace API\User\Http\Resources;


use Carbon\Carbon;
use CMS\Cart\Repository\CartRepository;
use CMS\Product\Service\ProductService;
use CMS\Ticket\Models\Ticket;
use CMS\Wallet\Repository\WalletRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;
use CMS\Order\Repository\OrderRepository;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $roleName= "user";
        $roleNames = $this->getRoleNames();
        if($roleNames){
            $roleName = $roleNames->first();

        }
        $user=request()->user();
        $cart=CartRepository::get_cart($user);
        $cart_products=ProductService::get_cart_products($cart);
        $cart_products_total_number=ProductService::get_cart_products_total_number();

        $wallet=WalletRepository::user_wallet($this);
        //$product_orders=OrderRepository::user_all_orders($this,null,"currency_income");
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'slug' => $this->slug,
            'role'=>$roleName,
            'url' => $this->url,
            'wallet' => $wallet? format_price_with_currencySymbol($wallet->price) :0,
            'wallet_amount' => $wallet? $wallet->price :0,
            'avatar' => $this->profile_avatar,
            'addresses' => $this->address,
            'bank_carts' => $this->bank_cart,
            'national_code' => $this->national_code,
            'cart_products_total_number' => $cart_products_total_number,
            'city' => $this->city,
            'unchecked_tickets' =>Ticket::query()
                ->where("user_id", $this->id)
                ->where(function($query) {
                    $query->where("status", "پاسخ داده شده")
                        ->orWhere("status", "در انتظار پاسخ کاربر");
                })
                ->count()
        ,
            'state' => $this->state,
            'address' => $this->main_address,
            'birthday' => $this->birthday,
            'authorize_decline_reason' => $this->authorize_decline_reason,
            'authorize_status' => $this->authorize,
            'authorize_data'=>[
                'name' => $this->authorize_name,
                'last_name' => $this->authorize_last_name,
                'national_code' => $this->authorize_national_code,
                'phone' => $this->authorize_phone,
                'year' => $this->authorize_year,
                'month' => $this->authorize_month,
                'day' => $this->authorize_day,
                'city' => $this->authorize_city,
                'state' => $this->authorize_state,
                'postal_code' => $this->authorize_postal_code,
                'static_phone' => $this->authorize_static_phone,
                'address' => $this->authorize_address,
                'national_image' => $this->authorize_national_cart_image,
                'self_image' => $this->authorize_self_image,
            ],
            //'product_orders' => ProductOrderResource::collection($product_orders),
            'created_at' => IR_TimestampToDate(Carbon::parse($this->created_at)->format("d-m-Y"),'Y/n/j'),

        ];
    }
}
