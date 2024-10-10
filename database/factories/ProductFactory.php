<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'name' => $this->faker->word(), // Tạo một tên sản phẩm ngẫu nhiên
            'price' => $this->faker->randomFloat(2, 10, 1000), // Tạo giá sản phẩm từ 10 đến 1000
            'sale_price' => $this->faker->randomFloat(2, 5, 900), // Giá khuyến mãi
            'discount' => $this->faker->numberBetween(0, 100), // Giảm giá từ 0 đến 100%
            'image' => $this->faker->imageUrl(640, 480, 'products'), // URL hình ảnh ngẫu nhiên
            'category_id' => $this->faker->numberBetween(1, 10), // ID danh mục ngẫu nhiên (giả định có 10 danh mục)
            'slug' => $this->faker->slug(), // Tạo slug cho sản phẩm
            'description' => $this->faker->text(), // Mô tả sản phẩm
            'stock' => $this->faker->numberBetween(0, 100), // Số lượng tồn kho
        ];
    }
}
