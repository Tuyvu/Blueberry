<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ImgProduct;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=  Category::all();
        return view('admin.product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        $fileName = $request->photo->getClientOriginalName();
        $request->photo->storeAs('public/images',$fileName);
        $request->merge(['image'=> $fileName]);
        try {
            
            $product = Product::create($request->all());
            
            if ($product && $request->hasFile('photos')) {
                foreach ($request->photos as $key => $value) {
                    $fileNames = $value->getClientOriginalName();
                    $value->storeAs('public/images',$fileNames);
                    ImgProduct::create([
                        'product_id'=>$product->id,
                        'image'=>$fileNames
                    ]);
                }
            }
        return redirect()->route('product.index');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)  
    {
        $categories = Category::all();
        return view('admin.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if($request->hasFile('photo')){
            $fileName = $request->photo->getClientOriginalName();
            $request->photo->storeAs('public/images',$fileName);
            $request->merge(['image'=> $fileName]);
        }
        try {
            
            $product->update($request->all());
            
            if ($product && $request->hasFile('photos')) {
                ImgProduct::where('product_id', $product->id)->delete();
                foreach ($request->photos as $key => $value) {
                    $fileNames = $value->getClientOriginalName();
                    $value->storeAs('public/images',$fileNames);
                    ImgProduct::create([
                        'product_id' => $product->id,
                        'image' => $fileNames
                    ]);
                }
            }
        return redirect()->route('product.index')->with('success','cap nhat thanh cong');
        } catch (\Throwable $th) {
            // return redirect()->back()->with('error','cap nhat that bai');
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete(); // Xóa mềm product và tự động xóa mềm các ImgProduct liên quan
            return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xóa sản phẩm thất bại');
        }
    }
    public function restore()
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.product.restore',compact('products'));
    }
    public function restore_id($id)
    {
        Product::withTrashed()->where('id',$id)->restore();
        return redirect()->route('product.index')->with('error','khôi phục thành công');
       
    }
    public function foredelete($id)
    {
        Product::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('product.restore')->with('error','xóa thành công');
       
    }
}
