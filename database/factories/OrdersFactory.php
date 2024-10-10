<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users_id' => $this->faker->numberBetween(1, 50), // Giả định có 50 người dùng
            'fullname' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'note' => $this->faker->sentence(),
            'shiptype' => $this->faker->randomElement(['1', '0']), // Thay đổi nếu có nhiều loại hình vận chuyển
            'total_money' => $this->faker->randomFloat(2, 10, 500), // Tổng tiền từ 10 đến 500
            'pay' => $this->faker->randomElement(['1', '0']), // Trả tiền hay không
            'status' => $this->faker->randomElement(['1', '2', '0']), // Các trạng thái khác nhau
        ];
    }
}
