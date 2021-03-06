<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            "id" => $this->resource->id,
            "name" => $this->resource->name,
            "phone" => $this->resource->phone,
            "gender"=> $this->resource->gender,
            "date_of_birth"=> $this->resource->date_of_birth,
            "address"=> $this->resource->address,
            "complaints"=> $this->resource->complaints,
            "policy_no"=> $this->resource->reference_no,
            "note"=> $this->resource->note,
            "hotel_room"=> $this->resource->hotel_room,
        ];
    }
}
