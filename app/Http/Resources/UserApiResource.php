<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserApiResource extends JsonResource
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
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
          //  'formated_name'=>$this->formattedName(),
            'email'     =>$this->email,
            'phone'     =>$this->mobile,
          //  'role'     =>$this->role()->role_name,
          //  'wallet'     =>$this->wallet,
            'api_token' =>$this->api_token



        ];
    }
}
