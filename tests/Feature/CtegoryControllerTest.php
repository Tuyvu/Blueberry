<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;

class CtegoryControllerTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();

        // Tạo dữ liệu cho bảng roles
        Role::factory()->create(['id' => 1, 'name' => 'admin']);
        Role::factory()->create(['id' => 2, 'name' => 'staff']);
        Role::factory()->create(['id' => 3, 'name' => 'user']);
    }
    protected function loginAsAdmin($id)
    {
        $adminUser = User::factory()->create(['role_id' => $id]);
        $this->actingAs($adminUser);
    }
    public function testIndexReturnsPaginatedCategories()
    {
        $this->loginAsAdmin(2);
        // Mock the paginated data
        $category = Category::factory()->count(10)->create();
        $response = $this->get(route('category.index'));
        $response->assertViewHas('categories', function ($paginatedCategory) {
            return $paginatedCategory->total() == 10 && $paginatedCategory->perPage() == 10;
        });
        $response->assertStatus(200); // Ensure the response is OK
        $response->assertViewIs('admin.category.index'); // Ensure the correct view is rendered
    }
    public function testcreateCtegory()
    {
        $this->loginAsAdmin(2);
        // Mock the paginated data
        $response = $this->get(route('category.create'));
        $response->assertStatus(200); // Ensure the response is OK
        $response->assertViewIs('admin.category.add'); // Ensure the correct view is rendered
    }
    public function teststoreCtegory()
    {
        $this->loginAsAdmin(2);
        // Mock the paginated data
        $response = $this->get(route('category.create'));
        $response->assertStatus(200); // Ensure the response is OK
        $response->assertViewIs('admin.category.add'); // Ensure the correct view is rendered
    }
}
