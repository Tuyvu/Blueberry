<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Cart_items;
use App\Models\Cart;
use App\Helpers\addtoCart;
use Auth;


class CartNav extends Component
{
    /**
     * Create a new component instance.
     */
    public $cartCount;
    public function __construct()
    {
        
        $totalQuantity = 0;
        $user = Auth::user();
        if ($user) {
            $cart = new addtoCart();
        if($user->role_id==3){
        $cartid = Cart::where('user_id', $user->id)->first();
        $cart = Cart_items::where('cart_id',$cartid->id)->get();
        foreach ($cart as $item) {
            $totalQuantity += $item->quantity;
        }
        }
        
        $this->cartCount= $totalQuantity;
        }
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.cart-nav');
    }
}
