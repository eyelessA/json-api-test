<?php

namespace Tests\Feature;

use App\Models\Advert;
use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;


class AdvertTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */

    public function test_index()
    {
        $adverts = Advert::factory(10)->create();
        $this->assertDatabaseCount('adverts', 10);

        foreach ($adverts as $advert) {
            Image::factory(3)->create([
                'advert_id' => $advert->id,
            ]);
        }

        $this->assertDatabaseCount('adverts', 10);
        $this->assertDatabaseCount('images', 30);

        foreach ($adverts as $advert) {
            $firstImage = $advert->images()->first();
            $this->assertEquals($advert->images->first()->id, $firstImage->id);
        }

        $response = $this->get('/api/adverts?' . 'order_by=price_desc&order_by=price_asc&order_by=created_at_desc&order_by=created_at_asc');
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $advert = Advert::factory()->create();
        $image = Image::factory()->create([
            'advert_id' => $advert->id
        ]);

        $response = $this->get('/api/adverts/' . $advert->id);

        $response->assertJson([
            'data' => [
                'id' => $advert->id,
                'name' => $advert->name,
                'images' => [
                    [
                        'id' => $image->id,
                        'image_url' => $image->image_url,
                        'advert_id' => $image->advert_id,
                        'created_at' => Carbon::parse($image->created_at)->toISOString(),
                        'updated_at' => Carbon::parse($image->updated_at)->toISOString(),
                        'deleted_at' => $image->deleted_at ? Carbon::parse($image->deleted_at)->toISOString() : null,
                    ]
                ],
                'price' => $advert->price,
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_show_with_more_images()
    {
        $advert = Advert::factory()->create();
        $images = Image::factory(3)->create(
            [
                'advert_id' => $advert->id
            ]
        );
        $response = $this->get('/api/adverts/' . $advert->id .'?fields[]=images&fields[]=description');
        $response->assertJson([
            'data' => [
                'id' => $advert->id,
                'name' => $advert->name,
                'description' => $advert->description,
                'images' => [],
                'price' => $advert->price,
            ]
        ]);

        foreach ($images as $image) {
            $response->assertJsonFragment([
                'id' => $image->id,
                'image_url' => $image->image_url,
                'advert_id' => $image->advert_id,
                'created_at' => $image->created_at,
                'updated_at' => $image->updated_at,
                'deleted_at' => $image->deleted_at,
            ]);
        }

        $response->assertStatus(200);
    }

    public function test_store_success()
    {
        $data = [
            'name' => 'test',
            'description' => 'test',
            'images' => [
                ['url' => 'https://blog.skillfactory.ru/wp-content/uploads/2023/02/laravel2-5683011.png'],
                ['url' => 'https://blog.skillfactory.ru/wp-content/uploads/2023/02/laravel2-5683011.png'],
                ['url' => 'https://blog.skillfactory.ru/wp-content/uploads/2023/02/laravel2-5683011.png'],
            ],
            'price' => 123
        ];

        $response = $this->post('/api/adverts', $data);
        $response->assertStatus(201);
    }

    public function test_store_invalid()
    {
        $invalidData = [
            'name' => 'test',
            'description' => 'test',
            'images' => [
                ['url' => '1'],
                ['url' => 'https://blog.skillfactory.ru/wp-content/uploads/2023/02/laravel2-5683011.png'],
                ['url' => 'https://blog.skillfactory.ru/wp-content/uploads/2023/02/laravel2-5683011.png'],
            ],
            'price' => 123
        ];

        $response = $this->postJson('/api/adverts', $invalidData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('images.0.url');
    }
}
