<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductWithFavoriteRecource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        

        return [

            'product_id'=>$this->id,
            'product_company_name'=>$this->company_name,
            'product_name'=>$this->product_name,
            'product_group_name'=>$this->group_name,
            'product_country_of_manufacture'=>$this->country_of_manufacture,
            'product_image_name'=>$this->image_name,
            'product_rate'=>$this->rate,
            'is_favorite'=>$this->favorit,
            'is_avilable'=>$this->avileble,
            'discraption'=>$this->discraaption,
            'online_price'=>$this->online_price,

        ];
    }
}
