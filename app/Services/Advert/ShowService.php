<?php

namespace App\Services\Advert;

use App\Models\Advert;

readonly class ShowService
{
    public function show(int $advertId): Advert
    {
        return Advert::query()->findOrFail($advertId);
    }
}
