<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $firstImage = $this->images->first();

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'images' => $firstImage ? [$firstImage] : [],
            'price' => $this->price,
        ];

        if ($request->get('fields') !== null) {
            if (in_array('images', $request->get('fields'))) {
                $data['images'] = $this->images;
            }
            if (in_array('description', $request->get('fields'))) {
                $data['description'] = $this->description;
            }
        }

        return  $data;
    }
}
