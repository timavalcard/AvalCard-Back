<?php


namespace API\User\Http\Resources;


use Carbon\Carbon;
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
        $product_orders=OrderRepository::user_all_orders($this);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'slug' => $this->slug,
            'role'=>$roleName,
            'url' => $this->url,
            'avatar' => $this->profile_avatar,
            'addresses' => $this->address,
            'birthday' => $this->birthday,
            'product_orders' => ProductOrderResource::collection($product_orders),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),

        ];
    }
}
