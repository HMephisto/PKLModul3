<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\JwtTestCase;

class ProductTest extends JwtTestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_product_all()
    {
        $response = $this->get('/api/products/');
        $response->assertStatus(200)
            ->assertJsonStructure($this->productPaginate);
    }

    public function test_product_detail()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create([
            'brand_id' => $brand->id,
        ]);
        $response = $this->get('/api/products/' . $product->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'price',
                    'image',
                    'brand_id',
                    'brand' => [],
                    'categories' => [],
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_product_store()
    {
        $brand = Brand::factory()->create();
        $payload = [
            'name' => fake()->name(),
            'price' => rand(1000, 10000),
            'brand_id' => $brand->id,
            'image' => fake()->name(),
        ];
        $response = $this->postJson('/api/products/', $payload);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'price',
                    'image',
                    'brand_id',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'name' => $payload["name"],
            'price' => $payload["price"],
            'image' => $payload["image"],
            'brand_id' => $payload["brand_id"],
        ]);
    }

    public function test_product_file_upload()
    {
        Storage::fake('public');
        $response = $this->post('/api/products/upload', [
            'image' => UploadedFile::fake()->image('random.jpg')
        ])->decodeResponseJson();
        Storage::disk('public')->assertExists('images/' . $response['data']['filename']);
    }

    public function test_product_search()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create([
            'brand_id' => $brand->id,
        ]);
        $response = $this->get('/api/products/search?name=' . $product->name);
        $response->assertStatus(200)
            ->assertJsonStructure($this->productPaginate)
            ->assertJson([
                "data" => [
                    "Product" => [
                        [
                            "name" => $product->name
                        ]
                    ]
                ]
            ]);
    }

    public function test_product_update()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create();
        $payload = [
            'name' => fake()->name(),
            'price' => rand(1000, 10000),
            'brand_id' => $brand->id,
            'image' => fake()->name(),
        ];
        $response = $this->putJson('/api/products/' . $product->id, $payload);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'price',
                    'image',
                    'brand_id',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'name' => $payload["name"],
            'price' => $payload["price"],
            'image' => $payload["image"],
            'brand_id' => $payload["brand_id"],
        ]);

        $this->assertDatabaseMissing('products', [
            'name' => $product["name"],
            'price' => $product["price"],
            'image' => $product["image"],
            'brand_id' => $product["brand_id"],
        ]);
    }

    public function test_delete_product()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create();
        $response = $this->delete('/api/products/' . $product->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'price',
                    'image',
                    'brand_id',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseMissing('products', [
            'name' => $product["name"],
            'price' => $product["price"],
            'image' => $product["image"],
            'brand_id' => $product["brand_id"],
        ]);
    }

    public function test_add_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $response = $this->postJson('/api/products/category', [
            "product_id" => $product->id,
            "category_id" => $category->id
        ]);
        $response->assertStatus(200)
            ->assertJson([
                "status" => "success",
                "message" => "Category added successfully"
            ]);

        $this->assertDatabaseHas('category_details', [
            "product_id" => $product->id,
            "category_id" => $category->id
        ]);
    }

    public function test_remove_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $response = $this->deleteJson('/api/products/category', [
            "product_id" => $product->id,
            "category_id" => $category->id
        ]);
        $response->assertStatus(200)
            ->assertJson([
                "status" => "success",
                "message" => "Category removed successfully"
            ]);

        $this->assertDatabaseMissing('category_details', [
            "product_id" => $product->id,
            "category_id" => $category->id
        ]);
    }

    private $productPaginate = [
        'status',
        'message',
        'data' => [
            'Product' => [[
                'name',
                'price',
                'image',
                'brand_id',
                'brand' => [],
                'categories' => [],
                'created_at',
                'updated_at'
            ]],
            'productCount'
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
