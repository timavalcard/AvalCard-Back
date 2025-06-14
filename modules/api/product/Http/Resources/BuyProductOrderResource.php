<?php


namespace API\Product\Http\Resources;


use Carbon\Carbon;
use CMS\Cart\Repository\CartRepository;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductRepository;
use CMS\Product\Repository\ProductVariationRepository;
use CMS\Product\Service\ProductService;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;

class BuyProductOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'order_type' => $this->order_type,
            'order_title' => $this->order_type == "gift_cart"
                ? "کیفت کارت"
                : ($this->order_type == "inter_payment"
                    ? "خرید از سایت خارجی"
                    : "خرید کالا"),
            'price' => format_price_with_currencySymbol($this->price),
            'status' => $this->status,
            'comment' => $this->comment,
            'payment_type' => $this->payment_type,
            'factor' => $this->factor,
            'coupon_name' => $this->coupon_name,
            'coupon_discount' => $this->coupon_discount,
            'created_at' => IR_TimestampToDate(Carbon::parse($this->created_at)->format("d-m-Y"),'Y/n/j'),
            'updated_at' => IR_TimestampToDate(Carbon::parse($this->updated_at)->format("d-m-Y"),'Y/n/j'),
        ];
    }
}
