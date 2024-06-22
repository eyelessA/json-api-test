<?php

namespace Database\Seeders;

use App\Models\Advert;
use App\Models\Image;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // делаем через sleep, чтобы увидеть разницу во времени создания объявлений (для сортировки по дате создания)
        for ($i = 0; $i < 20; $i++) {
            $adverts[] = Advert::factory()->create();
            sleep(1);
        }

        foreach ($adverts as $advert) {
            Image::factory(3)->create([
                'advert_id' => $advert->id
            ]);
        }
    }
}
