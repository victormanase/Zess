<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data["patient"] = new PatientResource($this->resource->patient);
        $data["doctor"] = new DoctorResource($this->resource->doctor);
        return $data;
    }
}
