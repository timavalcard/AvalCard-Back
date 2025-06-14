<?php


namespace CMS\Order\Repository;



use Illuminate\Support\Facades\DB;
use CMS\Order\Models\Order;
use CMS\User\Repositories\UserRepository;
use Morilog\Jalali\Jalalian;

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
    public static function user_all_orders($user=null,$order_type=null,$except=null){
        if(!$user) $user=auth()->user();
        $orders=$user->orders()->orderByDesc("created_at");
        if($order_type){
            $orders->where("order_type",$order_type);
        }
        if($except){
            $orders->where("order_type","!=",$except);
        }
        return $orders->get();
    }


    public static function get_all_orders_by_status($status){
        $orders = Order::query()->orderByDesc("created_at");

        if (request()->order_type) {
            $orders = $orders->where("order_type", request()->order_type);
        }

        if (request()->from_date) {
            $fromDate = convertPersianToEnglishNumbers(request()->from_date);
            $from = Jalalian::fromFormat('Y/m/d', $fromDate)->toCarbon()->startOfDay();
            $orders = $orders->where('created_at', '>=', $from);
        }

        if (request()->to_date) {
            $toDate = convertPersianToEnglishNumbers(request()->to_date);
            $to = Jalalian::fromFormat('Y/m/d', $toDate)->toCarbon()->endOfDay();
            $orders = $orders->where('created_at', '<=', $to);
        }

        if (request()->mobile) {
            $mobile = convertPersianToEnglishNumbers(request()->mobile);
            $orders = $orders->whereHas('user', function ($query) use ($mobile) {
                $query->where('mobile', 'like', "%$mobile%");
            });
        }

        return $orders->where("status",$status)->paginate(20);
    }

    public static function get_all_orders($paginate=true)
    {
        $orders = Order::query()->orderByDesc("created_at");

        if (request()->order_type) {
            $orders = $orders->where("order_type", request()->order_type);
        }

        if (request()->from_date) {
            $fromDate = convertPersianToEnglishNumbers(request()->from_date);
            $from = Jalalian::fromFormat('Y/m/d', $fromDate)->toCarbon()->startOfDay();
            $orders = $orders->where('created_at', '>=', $from);
        }

        if (request()->to_date) {
            $toDate = convertPersianToEnglishNumbers(request()->to_date);
            $to = Jalalian::fromFormat('Y/m/d', $toDate)->toCarbon()->endOfDay();
            $orders = $orders->where('created_at', '<=', $to);
        }

        if (request()->mobile) {
            $mobile = convertPersianToEnglishNumbers(request()->mobile);
            $orders = $orders->whereHas('user', function ($query) use ($mobile) {
                $query->where('mobile', 'like', "%$mobile%");
            });
        }
        if($paginate){
        return $orders->paginate(20);

        } else{
            return $orders->get();
        }
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
        $oldFactor = $order->factor ?? []; // فاکتور قبلی رو بگیر

// فقط فیلدهای موردنظر رو آپدیت کن
        $oldFactor['phone'] = $request['phone'] ?? ($oldFactor['phone'] ?? '');
        $oldFactor['postal_code'] = $request['postal_code'] ?? ($oldFactor['postal_code'] ?? '');
        $oldFactor['address'] = $request['address'] ?? ($oldFactor['address'] ?? '');
        return $order->update([
            "user_id"=>$request["user_id"]?? $order->user_id,
            "status"=>$request["status"],
            "factor"=>$oldFactor,
            "post_tracking_code"=>$request["post_tracking_code"]??$order->post_tracking_code,
            "delivery_status"=>$request["delivery_status"]??$order->delivery_status,
            "price"=>$request["price"]??$order->price,
        ]);
    }

    public static function destroy($ids)
    {
        Order::destroy($ids);
    }




    public static function add_order($request,$status="pending",$order_type="order",$is_course=false)
    {
        $user=UserRepository::find($request["user_id"]);
        /*$user_billing=get_user_meta(auth()->user()->id,"selected_address")->meta_value;
        $address=[
            "billing_first_name"=>$user_billing["billing_first_name"]??"",
            "billing_last_name"=>$user_billing["billing_last_name"]??"",
            "billing_email"=>$user_billing["billing_email"]??"",
            "billing_phone"=>$user_billing["billing_phone"]??"",
            "billing_state"=>$user_billing["billing_state"]??"",
            "billing_city"=>$user_billing["billing_city"]??"",
            "billing_postcode"=>$user_billing["billing_postcode"]??"",
            "billing_address"=>$user_billing["billing_address"]??"",

        ];*/

        return Order::create([
            "user_id"=>$request["user_id"],
            "price"=>$request["price"],
            "products_id"=>$request["products_id"]??"",
            "factor"=>[],
            "status"=>$status,
            "address"=>[],
            "order_type"=>$order_type,
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
