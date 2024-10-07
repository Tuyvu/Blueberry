<?php
namespace App\Helpers;

use App\Models\Cart as CartModel;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class addtoCart
{
    private $cart;
    private $items = [];

    public function __construct()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        $user = Auth::user();

        // Lấy hoặc tạo giỏ hàng cho người dùng
        $this->cart = CartModel::firstOrCreate(['user_id' => $user->id]);

        // Lấy các mục giỏ hàng từ cơ sở dữ liệu
        $this->items = $this->cart->items()->get()->keyBy('product_id')->toArray();
    }

    public function list()
    {
        return $this->items;
    }

    public function add($product, $quantity = 1)
    {
        $productId = $product->id;

        if (isset($this->items[$productId])) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $cartItem = $this->cart->items()->where('product_id', $productId)->first();
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng
            $this->cart->items()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'status', 
                'image' => $product->image,
                'price' => $product->sale_price > 0 ? $product->sale_price : $product->price,
                'quantity' => $quantity,
            ]);
        }

        // Cập nhật giỏ hàng sau khi thêm sản phẩm
        $this->items = $this->cart->items()->get()->keyBy('product_id')->toArray();
    }

    public function remove($productId)
    {
        // Xoá sản phẩm khỏi giỏ hàng
        $this->cart->items()->where('product_id', $productId)->delete();
        unset($this->items[$productId]);
    }

    public function clear()
    {
        // Xoá tất cả sản phẩm khỏi giỏ hàng
        $this->cart->items()->delete();
        $this->items = [];
    }
}
