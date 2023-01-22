<?php

namespace App\Http\Resources;

use App\Models\Proizvodjac;
use App\Models\Tip;
use Illuminate\Http\Resources\Json\JsonResource;

class SpravaResurs extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $tip = Tip::find($this->tipID);
        $proizvodjac = Proizvodjac::find($this->proizvodjacID);

        return [
            'id' => $this->id,
            'tip' => $tip->nazivTipa,
            'model' => $this->model,
            'proizvodjac' => $proizvodjac->nazivProizvodjaca,
            'cena' => $this->cena
        ];
    }
}
