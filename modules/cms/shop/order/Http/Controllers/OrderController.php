<?php

namespace CMS\Order\Http\Controllers;


use App\Http\Controllers\Controller;
use CMS\Order\Models\OrderLog;
use CMS\Sms\Services\SmsService;
use Illuminate\Http\Request;
use CMS\Cart\Repository\CartRepository;
use CMS\Order\Http\Requests\AddOrderRequest;
use CMS\Order\Models\Order;
use CMS\Order\Repository\OrderRepository;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Service\CouponService;
use CMS\Product\Service\ProductService;
use CMS\Shop\Repository\ShopRepository;
use CMS\Shop\Service\ShopService;
use CMS\Transaction\Events\TransactionSucceed;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\User\Repositories\UserRepository;
use CMS\Wallet\Services\WalletService;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    //theme functions
    public function add(Request $request){

        $cart=CartRepository::get_cart();
        if($cart){


            $cart_products=ProductService::get_cart_products($cart);


            $amount=ShopService::get_order_total_price();
            $gateway_name=$request->gateway;
            $factor=ShopService::create_order_factor($amount,$cart,$cart_products);

            $data=["user_id"=>auth()->id(),"products_id"=>$cart,"price"=>$amount,"payment_type"=>$gateway_name,"factor"=>$factor];
            if($gateway_name=="home"){
                $status=Order::$PROCESSING;
            }
            else{
                $status=Order::$PENDING;
            }
            $order=OrderRepository::add_order($data,$status);


            if($amount > 0 && $gateway_name!="home"){
                CouponService::remove_coupon_session();
                return ShopService::send_to_gateway($gateway_name,$amount,$order);

            }

            else{
                CouponService::remove_coupon_session();
                event(new TransactionSucceed($order));
                ProductService::if_product_in_stock_decrease_stock_number($cart_products,$cart);
                //todo send success order email
                return ShopService::transaction_succeed_redirection($order);
            }

        }

        return redirect()->route("home");

    }

    public function pay($id){
        $order=OrderRepository::find($id);
        $products=ProductService::get_cart_products($order->products_id);

        $amount=$order->price;
        $gateway_name=ShopRepository::get_first_gateway();
        $factor=ShopService::create_order_factor($amount,$order->products_id,$products);
        $order->factor=$factor;
        $order->save();
        return ShopService::send_to_gateway($gateway_name,$amount,$order);
    }

    // admin functions
    public function index(Request $request)
    {
        $statuses=Order::$statuses;

        if(isset($request->status)){
            $orders=OrderRepository::get_all_orders_by_status($request->status);
        } else{
            $orders=OrderRepository::get_all_orders();
        }
        $orders_count=OrderRepository::get_all_orders_count();
        return view("Order::Admin.index",["statuses"=>$statuses,"orders"=>$orders,"orders_count"=>$orders_count]);
    }

    public function group_action(Request $request){
        if($request->action == "delete"){
            OrderRepository::destroy($request->checkbox_item);
        } elseif (in_array($request->action,["completed","cancelled","processing"])){
            foreach($request->checkbox_item as $id){
                $order=OrderRepository::find($id);
                OrderRepository::update_status($order,$request->action);

            }
        }
        return back();
    }

    public function admin_add_order_form()
    {
        $statuses=Order::$statuses;
        return view("Order::Admin.create",["statuses"=>$statuses]);
    }

    public function admin_add_order(AddOrderRequest $request)
    {
        $order=OrderRepository::admin_add_order($request->all());
        return redirect()->route("admin_order_edit",["id"=>$order->id]);
    }

    public function edit_form($id)
    {
        $order=OrderRepository::find($id);
        $statuses=Order::$statuses;
        $delivery_statuses=Order::$delivery_statuses;
        $user_billing=UserRepository::get_billing_meta($order->user);
        $order_products=ProductService::get_cart_products($order->products_id);

        if($order->order_type == "currency_income"){
            return view("Order::Admin.currency_income_edit",["statuses"=>$statuses,"delivery_statuses"=>$delivery_statuses,"order"=>$order,"user_billing"=>$user_billing,"order_products"=>$order_products]);
        }
        return view("Order::Admin.edit",["statuses"=>$statuses,"delivery_statuses"=>$delivery_statuses,"order"=>$order,"user_billing"=>$user_billing,"order_products"=>$order_products]);
    }

    public function admin_edit_order($id,AddOrderRequest $request)
    {
        $order=OrderRepository::find($id);
        if($order->order_type == "buy_product"){
            $order->comment=$request->order_comment;
        }
        $order->save();
        if ($request->price != $order->price) {
            OrderLog::create([
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'text' => "قیمت سفارش از {$order->price} به {$request->price} تغییر یافت."
            ]);
        }

        if ($request->status != $order->status) {
            if($order->user){
                if($order->order_type == "currency_income"){
                $result = SmsService::ultra('changeCurrencyIncomeOrderStatus', [$order->id], $order->user->mobile);
                } else{

                $result = SmsService::ultra('changeStatus', [$order->id], $order->user->mobile);
                }
            }

            $status=__($order->status);
            $new_status=__($request->status);
            OrderLog::create([
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'text' => "وضعیت سفارش از '{$status}' به '{$new_status}' تغییر یافت."
            ]);
        }


        OrderRepository::admin_edit_order($order,$request->all());
        return redirect()->route("admin_order_edit",["id"=>$order->id]);
    }

    public function admin_delete_order($id)
    {
        OrderLog::create([
            'user_id' => auth()->id(),
            'order_id' => $id,
            'text' => "سفارش پاک شد"
        ]);
        OrderRepository::destroy($id);
        return back();
    }


    public function exportOrders()
    {
        $orders = OrderRepository::get_all_orders(false);

        $headings = ['شناسه', 'کاربر', 'قیمت', 'وضعیت','نوع پرداخت', 'تاریخ'];

        $data = collect([$headings])->merge($orders->map(function ($order) {
            return [
                $order->id,
                $order->user? $order->user->name ." ".$order->user->last_name ."-".$order->user->mobile : "پاک شده",
                $order->formated_price,
                __($order->status),
                $order->payment_type,
                toShamsi($order->created_at,"Y/m/d H:i"),
            ];
        }));

        return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromCollection {
            protected $data;
            public function __construct(Collection $data)
            {
                $this->data = $data;
            }
            public function collection()
            {
                return $this->data;
            }
        }, 'orders.xlsx', ExcelFormat::XLSX);
    }



}
