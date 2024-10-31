<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category.index',compact('categories'));
    }
    public function create()
    {
        return view('admin.category.add');
    }
    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::create($request->all());
            return redirect()->route('category.index')->with('success','them moi thanh cong');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','them moi that bai');
        }
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->all());
            return redirect()->route('category.index')->with('success','cap nhat thanh cong');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','cap nhat that bai');
        }
    }
    public function destroy(Category $category)
    {
        $productCount = Product::where('category_id', $category->id)->count();

        if ($productCount > 0) {
            return redirect()->back()->with('error', 'Không thể xóa vì vẫn còn sản phẩm trong danh mục này');
        }
        try {
            $category->delete();
            return redirect()->route('category.index')->with('success','xóa thanh cong');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','xóa that bai');
        }
    }
    public function restore()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.category.restore',compact('categories'));
       
    }
    public function restore_id($id)
    {
        Category::withTrashed()->where('id',$id)->restore();
        return redirect()->route('category.index')->with('error','khôi phục thành công');
       
    }
    public function foredelete($id)
    {
        Category::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('category.restore')->with('error','xóa thành công');
       
    }
}
