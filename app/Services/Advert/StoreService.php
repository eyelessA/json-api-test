<?php

namespace App\Services\Advert;

use App\Models\Advert;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Throwable;

class StoreService
{
    /**
     * @throws Throwable
     */
    public function store($data): int
    {
        try {
            DB::BeginTransaction();

            $advert = Advert::query()->create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
            ]);

            foreach ($data['images'] as $image) {
                Image::query()->create([
                    'image_url' => $image['url'],
                    'advert_id' => $advert->id
                ]);
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $advert->id;
    }
}
