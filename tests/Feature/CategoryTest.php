<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\JwtTestCase;

class CategoryTest extends JwtTestCase
{
    use DatabaseTransactions;

    public function test_category_all()
    {
        $response = $this->get('/api/categories/');
        $response->assertStatus(200)
            ->assertJsonStructure($this->categoryPaginate);
    }

    public function test_category_detail()
    {
        $category = Category::factory()->create();
        $response = $this->get('/api/categories/' . $category->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'parent_id',
                    'child' => [],
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function test_category_search()
    {
        $category = Category::factory()->create();
        $response = $this->get('/api/categories/search?name=' . $category->name);
        $response->assertStatus(200)
            ->assertJsonStructure($this->categoryPaginate)
            ->assertJson([
                "data" => [
                    "Category" => [
                        [
                            "name" => $category->name
                        ]
                    ]
                ]
            ]);
    }

    public function test_category_store()
    {
        $payload = [
            'name' => fake()->name(),
        ];
        $response = $this->postJson('/api/categories/', $payload);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'parent_id',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => $payload["name"],
        ]);
    }

    public function test_category_update()
    {
        $category = Category::factory()->create();
        $payload = [
            'name' => fake()->name(),
        ];
        $response = $this->putJson('/api/categories/' . $category->id, $payload);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'parent_id',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => $payload["name"],
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => $category["name"],
        ]);
    }

    public function test_delete_category()
    {
        $category = Category::factory()->create();
        $response = $this->delete('/api/categories/' . $category->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'name',
                    'parent_id',
                    'created_at',
                    'updated_at'
                ]
            ]);

        $this->assertDatabaseMissing('categories', [
            'name' => $category["name"],
        ]);
    }

    private $categoryPaginate = [
        'status',
        'message',
        'data' => [
            'Category' => [[
                'name',
                'parent_id',
                'child' => [],
                'products' => [],
                'created_at',
                'updated_at'
            ]],
            'categoryCount'
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
