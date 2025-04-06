<?php


namespace CMS\Dashboard\Http\Controllers;


use App\Http\Controllers\Controller;
use CMS\Comment\Repository\CommentRepository;
use CMS\Order\Models\Order;
use CMS\Order\Repository\OrderRepository;
use CMS\Product\Repository\ProductRepository;
use CMS\RolePermissions\Models\Permission;

class DashboardController extends Controller
{


    public function index()
    {

        $orders=Order::all();
        $order_products_id = $orders->pluck("products_id");
        $products_ids = [];
        foreach ($order_products_id as $item) {
            foreach ($item as $parent_product) {
                foreach ($parent_product as $product) {
                    if(isset($products_ids[$product["id"]])){
                        $products_ids[$product["id"]]+=(int) $product["quantity"];

                    } else{
                        $products_ids[$product["id"]]=(int) $product["quantity"];
                    }
                }
            }

        }

        //sort($products_ids);
        uasort($products_ids, function($a, $b) {
            return $b - $a;
        });

        $products_ids=array_slice($products_ids, 0, 10,true);

        $most_selled_product=[];
        foreach ($products_ids as $product_id=>$product_quantity){
            if($product=ProductRepository::find_not_fail($product_id)){
                $product->selled=$product_quantity;
                $most_selled_product[]=$product;
            }

        }
        $all_orders = OrderRepository::getAllCount();
        $datesOrder = collect();
        foreach (range(-30, 0) as $i) {
            $datesOrder->put(now()->addDays($i)->format('Y-m-d'), 0);
        }
        $user_id = auth()->id();
        $summeryOrder = OrderRepository::getDailySummery($datesOrder, $user_id);

        $comments=CommentRepository::get_newest_comments();

        return view('Dashboard::Admin.dashboard',compact("all_orders","datesOrder","summeryOrder","most_selled_product","comments"));
    }
}
