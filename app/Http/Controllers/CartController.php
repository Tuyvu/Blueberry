<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\addtoCart;
use App\Models\Product;
use App\Models\Cart_items;
use App\Models\Cart;
use Auth;
use App\Models\Orders;
use App\Models\Orders_Details;
use Illuminate\Support\Facades\Config;
class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $product = Product::find($request->product_id);
        $cart = new addtoCart();
        $cart->add($product, $request->quantity);

        return redirect()->route('cart.view');
    }

    public function viewCart()
    {
        $user = Auth::user();
        $cartid = Cart::where('user_id', $user->id)->first();
        $cart = Cart_items::where('cart_id',$cartid->id)->get();
        return view('user.cart',compact('cart'));
    }
    public function deleteCart($id)
    {
        $user = Auth::user();
        $cartid = Cart::where('user_id', $user->id)->first();
        $cart = Cart_items::where('cart_id',$cartid->id)->where('product_id', $id)->delete();
        return redirect()->back();
    }
    public function checkout(Request $request)
    {
        $citiesArray = getAPICitY();

        $cities = [];
        if (is_array($citiesArray) && isset($citiesArray['data'])) {
            foreach ($citiesArray['data'] as $city) {
                // Thêm tên thành phố vào mảng $cities
                $cities[] = $city['name'];
            }
        }
        $user = Auth::user();
        $products = [];
        $selectedProducts = $request->input('selectedProductsJson');
        $selectedProducts = json_decode($selectedProducts, true);
        $order = Orders::create([
            'users_id'=> $user->id,
            'fullname'=> $user->firstname . ' ' . $user->lastname,
            'phone'=> $user->phone,
            'email'=> $user->email,
            'address'=> $user->address,
            'note'=> '',
            'total_money' => 0
        ]);
        $totalMoney = 0;
        $orderid = $order->id;
        foreach ($selectedProducts as $product) {
    
            // Thêm vào bảng order_details
            Orders_Details::create([
                'orders_id' => $order->id,
                'product_id' => $product['product_id'],
                'price' => $product['price'],
                'discount' => 0,
                'total_money' => $product['totalprice'],
            ]);
            $item = Product::find($product['product_id']);
            $totalMoney += $product['totalprice'];
            $products[] = [
                'product' => $item,
                'quantity' => $product['quantity'],
                'totalprice' => $product['totalprice']
            ];
        }
        // $order->update(['total_money' => $totalMoney]);
        // dd($products);
        
        return view('user.checkout', compact('products','totalMoney','cities', 'orderid')); 
    }
    public function postcheckout(Request $request){
        // dd($request->all());
        $order = Orders::where('id', $request->order_id)->first();
        $user = Auth::user();
        if ($request->address == "old") {
            $order->update([
                'total_money' => $request->total_payment,
                'note' => $request->your_commemt,
            ]);
        } else {
            $order->update([
                'fullname'=> $request->fullname,
                'phone'=> $request->phone,
                'address'=> $request->address_detail,
                'total_money' => $request->total_payment,
                'note' => $request->your_commemt,
            ]);
        }
        if($request->rate == 15000){
            $order->update(['shiptype' => 1]);
        }
        if($request->radio_pay=="pay"){
            $order->update(['pay' => 1]);
            $cart = Cart::where('user_id', $user->id)->first();
            if ($cart) {
                foreach ($order->orderDetails as $item) {
                    Cart_items::where('cart_id', $cart->id)->where('product_id', $item->product_id)->delete();
                    $quantity = $item->total_money / $item->price;
                    $product = Product::where('id', $item->product_id)->first();
                    $quantity = $product->discount - $quantity;
                    $product->update(['discount' => $quantity]);
                }
            }
            return view('user.finishcheckout');
        }else{
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('cart.checkoutvnpay');
            $vnp_TmnCode = env('VNP_TMN_CODE');
            $vnp_HashSecret = env('VNP_HASH_SECRET'); 
            
            $vnp_TxnRef = $order->id; 
            $vnp_OrderInfo = 'Thanh toán đơn';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $order->total_money * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            // $vnp_ExpireDate = $_POST['txtexpire'];
            //Billing
            
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );
            
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }
            
            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
        }
    }
    public function checkoutvnpay(Request $request) {
            // dd($request->vnp_TxnRef);  
            $user = Auth::user();
            $order = Orders::where('id', $request->vnp_TxnRef)->first();
            $order->update(['pay' => 2]);
            $cart = Cart::where('user_id', $user->id)->first();
            if ($cart) {
                foreach ($order->orderDetails as $item) {
                    Cart_items::where('cart_id', $cart->id)->where('product_id', $item->product_id)->delete();
                    $quantity = $item->total_money / $item->price;
                    $product = Product::where('id', $item->product_id)->first();
                    $quantity = $product->discount - $quantity;
                    $product->update(['discount' => $quantity]);
                }
            }
            return view('user.finishcheckout'); 
        }
    
    
}
