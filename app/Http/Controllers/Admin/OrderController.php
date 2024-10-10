<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Orders;
use App\Models\Orders_Details;

class OrderController extends Controller
{
    public function getAllOrder()
    {
        $order = Orders::where('total_money', '!=',0)->where('status',0)->paginate(10);
        return view('admin.order.index', compact('order'));
    }
    public function getAllOrdercomfirm()
    {
        $order = Orders::where('status',1)->paginate(10);
        return view('admin.order.Ordercomfirm', compact('order'));
    }
    public function confirmOrder(Orders $order)
    {
        $products = Orders_Details::where('orders_id',$order->id)->get();
        return view('admin.order.comfirm', compact('order', 'products'));
    }
    public function finishOrder($id)
    {
        $order = Orders::where('id', $id)->update(['status' => 1]);
        return redirect()->route('admin.order');
    }
    public function confirmOrdership(Orders $order)
    {
        $products = Orders_Details::where('orders_id',$order->id)->get();
        // dd($order);
        return view('admin.order.comfirmship', compact('order', 'products'));

    }
    public function finishOrdership($id)
    {
        // dd($id);
        $order = Orders::where('id', $id)->update(['status' => 2])->update(['pay' => 2]);
        return redirect()->route('admin.ordership');
    }
    public function getAllOrdership()
    {
        $order = Orders::where('status',1)->paginate(10);
        return view('admin.order.Ordership', compact('order'));
    }
    public function getAllshipcomfirm()
    {
        $order = Orders::where('status',2)->paginate(10);
        return view('admin.order.Ordership', compact('order'));
    }
}
