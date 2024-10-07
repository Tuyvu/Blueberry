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
            return view('user.finishcheckout', compact('order'));
        }else{
            return redirect()->route('cart.checkoutvnpay', ['order_id' => $request->order_id]);
        }
    }
    public function checkoutvnpay(Request $request) {
        $order = Orders::where('id', $request->order_id)->first();
        if (!$order) {
            dd("loi đơn");
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }
        
        try {
            $vnp_TmnCode = Config::get('vnpay.vnp_TmnCode');
            $vnp_HashSecret = Config::get('vnpay.vnp_HashSecret');
            $vnp_Url = Config::get('vnpay.vnp_Url');
            $vnp_ReturnUrl = Config::get('vnpay.vnp_ReturnUrl');
        
            $vnp_TxnRef = $request->order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
            $vnp_OrderInfo = "Thanh toán đơn hàng";
            $vnp_OrderType = "billpayment";
            $vnp_Amount = 20000 * 100;
            $vnp_Locale = "vn";
            $vnp_BankCode = "NCB";
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
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
                "vnp_ReturnUrl" => $vnp_ReturnUrl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );
    
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
    
        // Kiểm tra nếu thông tin tỉnh/thành phố hóa đơn đã được thiết lập và không rỗng
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State; // Gán thông tin tỉnh/thành phố hóa đơn vào mảng dữ liệu input
        }

        // Sắp xếp mảng dữ liệu input theo thứ tự bảng chữ cái của key
        ksort($inputData);
    
        $query = ""; // Biến lưu trữ chuỗi truy vấn (query string)
        $i = 0; // Biến đếm để kiểm tra lần đầu tiên
        $hashdata = ""; // Biến lưu trữ dữ liệu để tạo mã băm (hash data)

        // Duyệt qua từng phần tử trong mảng dữ liệu input
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                // Nếu không phải lần đầu tiên, thêm ký tự '&' trước mỗi cặp key=value
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                // Nếu là lần đầu tiên, không thêm ký tự '&'
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1; // Đánh dấu đã qua lần đầu tiên
            }
            // Xây dựng chuỗi truy vấn
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        // Gán chuỗi truy vấn vào URL của VNPay
        $vnp_Url = $vnp_Url . "?" . $query;

        // Kiểm tra nếu chuỗi bí mật hash secret đã được thiết lập
        if (isset($vnp_HashSecret)) {
            // Tạo mã băm bảo mật (Secure Hash) bằng cách sử dụng thuật toán SHA-512 với hash secret
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            // Thêm mã băm bảo mật vào URL để đảm bảo tính toàn vẹn của dữ liệu
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        
        return redirect($vnp_Url);
            } catch (\Throwable $th) {
                dd($th); // Hiển thị lỗi nếu có
            }
        }
        public function return(Request $request)
        {
            
        }
    
    
}
