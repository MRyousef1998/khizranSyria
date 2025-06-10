<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ReviewResource;



class AuctionResource extends JsonResource
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
            'auction_id'=>$this->id,
            'auction_title'=>$this->title,
            'auction_description' => $this->description,
            'auction_price'=> $this->price,  
            'num_increment'=>$this->num_increment,
            'auction_end_time'=>$this ->end_time,
            
           'category'=> new  CategoryResource($this ->category),
            'auction_images'=>ImageResource::collection($this->images),
           // 
           'auction_company'=>new UserResource($this->user),
       'auction_review'=>ReviewResource::collection($this->reviews),
         
        
        ];
    }
}
