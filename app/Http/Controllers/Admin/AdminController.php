<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use App\Models\Orders;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Product;


class AdminController extends Controller
{
    public function index() {
        $products = Product::orderBy('discount', 'asc')->take(6)->get();
        $category = Category::all();
        $categoryCount = $category->count();
        $total=0;
        $totaltoday=0;
        
        $order = Orders::where('total_money', '!=',0)->where('pay',1)->take(6)->get();
        foreach ($order as $item) {
            $total=$total+$item->total_money;
        }
        $orders = Orders::where('total_money', '!=', 0)
        ->where('pay', 1)
        ->whereDate('created_at', Carbon::today())
        ->get();
        $count = $orders->count();
        foreach ($orders as $item) {
            $totaltoday=$totaltoday+$item->total_money;
        }
        $user = User::where('role_id', 3)->get();
        $usercount=$user->count();
        // $total=$total*1000;
        return view('admin.dasboard', compact('total','order','categoryCount','count','totaltoday','usercount','products'));
    }
    public function logon() {
        return view('admin.logon');
    }
    public function postlogon(Request $req) {
        try{
            if (Auth::attempt([
            'email' => $req->email,
            'password' => $req->password,
            // 'role_id' => '2'
        ])) {
            
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->with('error', 'Sai mật khẩu hoặc email');
        }
        return redirect()->route('logon');
        } catch (\Exception $e) {
            dd("Lỗi: " . $e->getMessage());
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('logon');
    }
    public function customer()
    {
        $user = User::where('role_id', 3)->paginate(2);
        return view('admin.customer.index',compact('user'));
    }
    public function uploadimage()
    {
        return view('admin.addimage');
    }
    public function postuploadimage(Request $request)
    {
        if($request->hasFile('photo')){
            $fileName = time() . '_' . $request->photo->getClientOriginalName();
            $path = $request->photo->storeAs('public/images/products', $fileName);
        }else{
            return redirect()->back()->with('error', 'Chưa chọn ảnh');
        }
        return redirect()->back()->with('success', 'Chọn ảnh thêm ảnh thành công');
    }
    public function staff()
    {
        $user = User::where('role_id', 2)->paginate(10);
        return view('admin.staff.index',compact('user'));
    }
    public function addstaff()
    {
        return view('admin.staff.add');
    }
    public function postaddstaff(Request $req)
    { 
    //    dd($request->all());
       $req->merge(['password'=>Hash::make($req->password)]);
        $req->merge(['role_id' => 2]);
        try {
            User::create($req->all());
        } catch (\Throwable $th) {
            dd($th);
        }
       return redirect()->route('sadmin.staff');
    }

    
}
