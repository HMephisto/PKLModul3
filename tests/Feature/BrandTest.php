<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\JwtTestCase;

class BrandTest extends JwtTestCase
{
    use DatabaseTransactions;

    public function test_brand_all()
    {
        $response = $this->get('/api/brands/');
        $response->assertStatus(200)
            ->assertJsonStructure($this->brandPaginate);
    }

    public function test_brand_detail()
    {
        $brand = Brand::factory()->create();
        $response = $this->get('/api/brands/' . $brand->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'image',
                    'products' => [],
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_brand_detail_fail()
    {
        $response = $this->get('/api/brands/999999');
        $response->assertStatus(404);
    }

    public function test_brand_store()
    {
        $payload = [
            'name' => fake()->name(),
            'image' => fake()->name(),
        ];
        $response = $this->postJson('/api/brands/', $payload);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'image',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('brands', [
            'name' => $payload["name"],
            'image' => $payload["image"],
        ]);
    }

    public function test_brand_file_upload()
    {
        Storage::fake('public');
        $response = $this->post('/api/brands/upload', [
            'image' => UploadedFile::fake()->image('random.jpg')
        ])->decodeResponseJson();
        Storage::disk('public')->assertExists('images/' . $response['data']['filename']);
    }

    public function test_brand_search()
    {
        $brand = Brand::factory()->create();
        $response = $this->get('/api/brands/search?name=' . $brand->name);
        $response->assertStatus(200)
            ->assertJsonStructure($this->brandPaginate)
            ->assertJson([
                "data" => [
                    "brand" => [
                        [
                            "name" => $brand->name
                        ]
                    ]
                ]
            ]);
    }

    public function test_brand_update()
    {
        $brand = Brand::factory()->create();
        $payload = [
            'name' => fake()->name(),
            'image' => fake()->name(),
        ];
        $response = $this->putJson('/api/brands/' . $brand->id, $payload);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'image',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('brands', [
            'name' => $payload["name"],
            'image' => $payload["image"],
        ]);

        $this->assertDatabaseMissing('brands', [
            'name' => $brand["name"],
            'image' => $brand["image"],
        ]);
    }

    public function test_delete_brand()
    {
        $brand = Brand::factory()->create();
        $response = $this->delete('/api/brands/' . $brand->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'image',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseMissing('brands', [
            'name' => $brand["name"],
            'image' => $brand["image"],
        ]);
    }

    private $brandPaginate = [
        'status',
        'message',
        'data' => [
            'brand' => [[
                'name',
                'image',
                'products' => [],
                'created_at',
                'updated_at'
            ]],
            'brandCount'
        ],
        "links" => [
            "first",
            "last",
            "prev",
            "next"
        ],
        "meta" => [
            "current_page",
            "from",
            "last_page",
            "links" => [
                [
                    "url",
                    "label",
                    "active"
                ],
                [
                    "url",
                    "label",
                    "active"
                ],
                [
                    "url",
                    "label",
                    "active"
                ]
            ],
            "path",
            "per_page",
            "to",
            "total"
        ]
    ];
}
