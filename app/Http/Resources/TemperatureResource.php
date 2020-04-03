<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TemperatureResource extends JsonResource
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
            'id'           => $this->id,
            'patientEmail' => $this->patientEmail,
            'maxTemp'      => $this->maxTemp,
            'minTemp'      => $this->minTemp,
            'updatedBy'    => $this->updatedEmail
        ];
    }
}
