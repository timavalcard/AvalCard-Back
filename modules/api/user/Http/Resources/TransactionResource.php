<?php


namespace API\User\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use API\Category\Http\Resources\CategoryResource;
use CMS\Order\Repository\OrderRepository;

class TransactionResource extends JsonResource
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
            'price'=>format_price_with_currencySymbol($this->price),
            'status'=>$this->status,
            'created_at' => IR_TimestampToDate(Carbon::parse($this->created_at)->format("d-m-Y"),'Y/n/j'),

        ];
    }
}
