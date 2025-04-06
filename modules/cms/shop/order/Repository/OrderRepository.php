<?php


namespace CMS\Order\Repository;



use Illuminate\Support\Facades\DB;
use CMS\Order\Models\Order;
use CMS\User\Repositories\UserRepository;

class OrderRepository
{
    public static function find($id)
    {
        return Order::find($id);
    }


    public static function user_find_order($id,$user=null){
        if(!$user) $user=auth()->user();

        return $user->orders()->findOrFail($id);
    }
    public static function user_all_orders($user=null){
        if(!$user) $user=auth()->user();
        return $user->orders()->orderByDesc("created_at")->get();
    }


    public static function get_all_orders_by_status($status){
        return Order::query()->where("status",$status)->orderByDesc("created_at")->paginate(15);
    }

    public static function get_all_orders()
    {
        return Order::query()->orderByDesc("created_at")->paginate(10);
    }
    public static function get_all_orders_count($status="")
    {
        if($status){
            return Order::query()
                ->where("status",$status)
                ->count();
        } else{
            return Order::query()->count();
        }
    }

    public static function getOrderByPeriod($start, $end){
        return Order::query()
            ->whereDate('created_at', '<=', $start)
            ->whereDate('created_at', '>=', $end)
            ->count();
    }
    public static function getOrdersByDays($date)
    {
        return Order::query()
            ->whereDate('created_at', $date)
            ->count();
    }
    public static function getAllCount()
    {
        return Order::query()->count();
    }
    public static function getDailySummery(\Illuminate\Support\Collection $dates, $seller_id = null)
    {
        $query = Order::query()
            ->where('created_at', '>', $dates->keys()->first())
            ->groupBy('date')
            ->orderBy('date');
//
//        if (!is_null($seller_id)) {
//            $query->where('seller_id', $seller_id);
//        }

        return $query->get([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(id) as total'),
        ]);

    }
    public static function admin_add_order($request)
    {
        return Order::create([
            "user_id"=>$request["user_id"],
            "products_id"=>$request["products_id"],
            "status"=>$request["status"],
            "price"=>$request["price"],
        ]);
    }




    public static function admin_edit_order(Order $order,$request)
    {
        $address=[
            "billing_first_name"=>$request["billing_first_name"]??"",
            "billing_last_name"=>$request["billing_last_name"]??"",
            "billing_email"=>$request["billing_email"]??"",
            "billing_phone"=>$request["billing_phone"]??"",
            "billing_state"=>$request["billing_state"]??"",
            "billing_city"=>$request["billing_city"]??"",
            "billing_postcode"=>$request["billing_postcode"]??"",
            "billing_address"=>$request["billing_address"]??"",

        ];
        return $order->update([
            "user_id"=>$request["user_id"],
            "status"=>$request["status"],
            "address"=>$address,
            "post_tracking_code"=>$request["post_tracking_code"],
            "delivery_status"=>$request["delivery_status"],
            "price"=>$request["price"],
        ]);
    }

    public static function destroy($ids)
    {
        Order::destroy($ids);
    }




    public static function add_order($request,$status="pending",$is_course=false)
    {
        $user=UserRepository::find($request["user_id"]);
        $user_billing=get_user_meta(auth()->user()->id,"selected_address")->meta_value;
        $address=[
            "billing_first_name"=>$user_billing["billing_first_name"]??"",
            "billing_last_name"=>$user_billing["billing_last_name"]??"",
            "billing_email"=>$user_billing["billing_email"]??"",
            "billing_phone"=>$user_billing["billing_phone"]??"",
            "billing_state"=>$user_billing["billing_state"]??"",
            "billing_city"=>$user_billing["billing_city"]??"",
            "billing_postcode"=>$user_billing["billing_postcode"]??"",
            "billing_address"=>$user_billing["billing_address"]??"",

        ];
        return Order::create([
            "user_id"=>$request["user_id"],
            "price"=>$request["price"],
            "products_id"=>$request["products_id"],
            "factor"=>$request["factor"],
            "status"=>$status,
            "address"=>$address,
            "delivery_status"=>Order::DELIVERY_INVOICE_TO_STOCK,
            "payment_type"=>$request["payment_type"],
            "is_course"=>$is_course,

        ]);
    }

    public static function update_status(Order $order,$status)
    {
        return $order->update([
            "status"=>$status,
        ]);
    }
}
