<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Hash;
use App\Models\Orders;
use App\Models\Category;
use Carbon\Carbon; 
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class AdminControllerTest extends TestCase
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

    public function testIndexReturnsViewWithCorrectData()
    {
        // Đăng nhập với user có role_id = 2
        $this->loginAsAdmin(2);

        $category = Category::factory()->create();
        // Tạo dữ liệu mẫu cho các sản phẩm
        Product::factory()->count(10)->create(['category_id' => $category->id]);
        
        // Tạo dữ liệu mẫu cho danh mục
        $user = User::factory()->create(['role_id' => 3]);
        // Tạo dữ liệu mẫu cho đơn hàng
        Orders::factory()->count(10)->create([
            'users_id' => $user->id,
            'total_money' => 100,
            'pay' => 1,
        ]);
        
        // Tạo dữ liệu cho đơn hàng hôm nay
        Orders::factory()->count(3)->create([
            'users_id' => $user->id,
            'total_money' => 200,
            'pay' => 1,
            'created_at' => Carbon::today(),
        ]);
        $response = $this->get(route('admin.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.dasboard');
        $response->assertViewHas('products', function ($products) {
            return $products->count() == 6;
        });
        $response->assertViewHas('total', 600); // Tổng tiền
        $response->assertViewHas('categoryCount', 1); // Số lượng danh mục
        $response->assertViewHas('count', 13); // Tổng số đơn hàng
        $response->assertViewHas('totaltoday', 1600); // Tổng tiền của đơn hàng hôm nay
        $response->assertViewHas('usercount', User::where('role_id', 3)->count()); // Số lượng người dùng
    }
    public function test_admin_can_log_in_with_correct_credentials()
    {
        $role = Role::create(['name' => 'Admin']);
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
            'role_id' => $role->id,
        ]);
        $response = $this->post(route('postlogon'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);
        $response->assertRedirect(route('admin.index'));
    }
    public function test_postlogon_redirects_back_on_failed_login()
    {
        $response = $this->post(route('postlogon'), [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect()->with('error', 'Sai mật khẩu hoặc email');
    }
    public function test_logout_redirects_to_logon()
    {
        $role = Role::create(['name' => 'Admin']);
        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);
        $this->actingAs($user);

        $response = $this->get(route('admin.logout'));

        $response->assertRedirect(route('logon'));
    }
    public function test_customer_method_requires_admin_role()
    {
        $user = User::factory()->create(['role_id' => 3]);
        $this->actingAs($user);
        $response = $this->get(route('admin.customer'));
        $response->assertStatus(302); // Forbidden
    }

    public function test_admin_can_access_customer_method()
    {
        $admin = User::factory()->create(['role_id' => 2]);
        User::factory()->count(5)->create(['role_id' => 3]);
        $this->actingAs($admin);
        $response = $this->get(route('admin.customer'));
        $response->assertViewIs('admin.customer.index');
        $response->assertViewHas('user', function ($paginatedUsers) {
            return $paginatedUsers->total() == 5 && $paginatedUsers->perPage() == 2;
        });
        $response->assertStatus(200);
    }
    public function test_admin_can_access_uploadimage_method()
    {
        $this->loginAsAdmin(2);
        $response = $this->get(route('admin.uploadimages'));
        $response->assertViewIs('admin.addimage');
        $response->assertStatus(200);
    }
    public function test_admin_can_access_postuploadimage_method()
    {
        $this->loginAsAdmin(2);
        Storage::fake('public/images/products');
        $file = UploadedFile::fake()->image('photo.jpg');
        $response = $this->post(route('admin.postuploadimage'), [
            'photo' => $file,
        ]);
        $storedFileName = time() . '_' . $file->getClientOriginalName();
        Storage::disk('public')->assertExists('images/products/' . $storedFileName);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Chọn ảnh thêm ảnh thành công');
    }
    public function test_admin_can_access_no_postuploadimage_method()
    {
        $this->loginAsAdmin(2);
        $response = $this->post(route('admin.postuploadimage'));
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Chưa chọn ảnh');
    }
    public function test_admin_can_access_showstaff_method()
    {
        // $this->loginAsAdmin(1);
        $admin = User::factory()->create(['role_id' => 1]);
        // User::factory()->count(5)->create(['role_id' => 3]);
        $this->actingAs($admin);
        $user = User::factory()->count(12)->create(['role_id' => 2]);
        $response = $this->get(route('sadmin.staff'));
        $response->assertViewIs('admin.staff.index');
        $response->assertViewHas('user', function ($paginatedUsers) {
            return $paginatedUsers->total() == 12 && $paginatedUsers->perPage() == 10;
        });
        $response->assertStatus(200);
    }
       public function test_admin_can_access_staff_method()
    {
        $this->loginAsAdmin(1);
        $response = $this->get(route('sadmin.addstaff'));
        $response->assertViewIs('admin.staff.add');
        $response->assertStatus(200);

    }
}
