<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Auth;
use App\Models\Orders;
use App\Models\Orders_Details;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public function login(){
        return view('user.login');
    }
    // public function register()
    // {
    //     $url = 'https://esgoo.net/api-tinhthanh/1/0.htm';
    //     return view('user.register');
    // }
    public function register()
{
    $citiesArray = getAPICitY();

    // Lấy danh sách tên thành phố từ phần 'data'
    $cities = [];
    if (is_array($citiesArray) && isset($citiesArray['data'])) {
        foreach ($citiesArray['data'] as $city) {
            // Thêm tên thành phố vào mảng $cities
            $cities[] = $city['name'];
        }
    }

    // Hiển thị biến $cities để kiểm tra
    // dd($cities);

    // Truyền danh sách thành phố vào view
    return view('user.register', compact('cities'));
}

    public function postlogin(Request $req){
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            return redirect()->route('user.index');
        }else{
            return redirect()->back()->with('error','sai mk');
        }
       return redirect()->route('user.login');
    }

    public function postregister(RegisterRequest $req){
        $req->merge(['password'=>Hash::make($req->password)]);
        $req->merge(['role_id' => 3]);
        try {
            User::create($req->all());
        } catch (\Throwable $th) {
            dd($th);
        }
       return redirect()->route('user.login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');

    }
    public function shiping()
    {
        $user = Auth::user();
        $orders = Orders::where('users_id',$user->id)->where('pay','!=', '0')->orderBy('created_at', 'desc')->get();
        return view('user.shiping',compact('orders'));
    }
    public function shipingWait()
    {
        $user = Auth::user();
        $orders = Orders::where('users_id',$user->id)->where('pay',1)->where('status',0)->orderBy('created_at', 'desc')->get();
        return view('user.shiping',compact('orders'));
    }
    public function shipingship()
    {
        $user = Auth::user();
        $orders = Orders::where('users_id',$user->id)->where('pay',1)->where('status',1)->orderBy('created_at', 'desc')->get();
        return view('user.shiping',compact('orders'));
    }
    public function Delivered()
    {
        $user = Auth::user();
        $orders = Orders::where('users_id',$user->id)->where('pay',1)->where('status',2)->orderBy('created_at', 'desc')->get();
        return view('user.shiping',compact('orders'));
    }
    public function Received()
    {
        $user = Auth::user();
        $orders = Orders::where('users_id',$user->id)->where('pay',1)->where('status',3)->orderBy('created_at', 'desc')->get();
        return view('user.shiping',compact('orders'));
    }
    public function detailshiping($order)
    {
        $orders = Orders::where('id',$order)->first();
        return view('user.detailshipping',compact('orders'));
    }
    public function finishshiping($orders)
    {
        $order = Orders::where('id',$orders)->first();
        $order->update([
            'status' => 3
        ]);
        return redirect()->route('user.index');
       
    }
    public function view360()
    {
        $images = Storage::files('public/images/products');
    
         // Sắp xếp ảnh theo thời gian để lấy ảnh mới nhất
         $latestImage = collect($images)
         ->map(function ($image) {
             return basename($image);
         })
         ->sortByDesc(function ($image) {
             return $image; // Sorting each image in descending order
         })
         ->first();
            // dd($latestImage);
        return view('user/view360', compact('latestImage'));
       
    }
    
}
