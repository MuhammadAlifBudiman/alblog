<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Optionally, seed permissions or assign admin roles here
        $this->user = User::factory()->create([
            'is_admin' => true,
        ]);
        $this->actingAs($this->user); // simulate logged-in user
    }

    public function test_index_displays_categories()
    {
        $category = Category::factory()->create();

        $response = $this->get('/dashboard/categories');

        $response->assertStatus(200);
        $response->assertViewHas('categories', function ($categories) use ($category) {
            return $categories->contains($category);
        });
    }

    public function test_create_view_loads()
    {
        $response = $this->get('/dashboard/categories/create');
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.categories.create');
    }

    public function test_store_saves_category_and_redirects()
    {
        $data = [
            'name' => 'Test Category',
            'slug' => 'test-category',
        ];

        $response = $this->post('/dashboard/categories', $data);

        $response->assertRedirect('/dashboard/categories');
        $this->assertDatabaseHas('categories', $data);
    }

    public function test_edit_view_displays_category()
    {
        $category = Category::factory()->create();

        $response = $this->get("/dashboard/categories/{$category->slug}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.categories.edit');
        $response->assertViewHas('category', $category);
    }

    public function test_update_modifies_category_and_redirects()
    {
        $category = Category::factory()->create([
            'name' => 'Old Name',
            'slug' => 'old-slug',
        ]);

        $updatedData = [
            'name' => 'Updated Name',
            'slug' => 'updated-slug',
        ];

        $response = $this->put("/dashboard/categories/{$category->slug}", $updatedData);

        $response->assertRedirect('/dashboard/categories');
        $this->assertDatabaseHas('categories', $updatedData);
    }

    public function test_destroy_deletes_category_and_redirects()
    {
        $category = Category::factory()->create();

        $response = $this->delete("/dashboard/categories/{$category->slug}");

        $response->assertRedirect('/dashboard/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_check_slug_returns_slug()
    {
        $response = $this->getJson('/dashboard/categories/checkSlug?name=My New Category');

        $response->assertStatus(200);
        $response->assertJsonStructure(['slug']);
    }
}
