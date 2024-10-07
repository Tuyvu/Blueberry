<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ImgProduct;
use App\Models\Category;

class HomeController extends Controller
{
    public function login(){
        return view('user.login');
    }
    public function postlgin(){
        return view('user.login');
    }
    public function home(Request $request)
    {
        $category = Category::all();
        $product = Product::where('stock','1')->get();
        $productAll = Product::all();

        $productorder = Product::orderBy('created_at','ASC')->get();
        return view('user.index', compact('product', 'productorder', 'category','productAll'));
    }
    public function findCategory($name)
{
    $category = Category::where('name', $name)->first();
    $products = Product::where('category_id', $category->id)->paginate(10);
    
    return view('user.categoryfind', compact('products', 'category'));
}

    public function findProduct(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->findproduct . '%')->paginate(2);
        return view('user.categoryfind', compact('products'));
    }
    public function detail($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $productcate = Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->get();
        // dd($productcate);
        return view('user.product',compact('product','productcate'));
    }
}
