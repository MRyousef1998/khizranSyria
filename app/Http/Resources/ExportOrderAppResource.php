<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExportOrderAppResource extends JsonResource
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
            'order_date'=>$this->order_date,
            'order_due_date'=>$this->order_due_date,
            'exporter_name'     =>$this->importer->name,
            'status_name'=>$this->status->status_name,
            'file_url'=> $this->image_name,
            'total'=>$this->Total,
            'cont'=>$this->countAllItem(),
            'note'=>$this->note,


            
        ];
    }
}
