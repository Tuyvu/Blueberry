<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::create($request->all());
            return redirect()->route('category.index')->with('success','them moi thanh cong');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','them moi that bai');
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
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('admin.category.edit',compact('category','categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->all());
            return redirect()->route('category.index')->with('success','cap nhat thanh cong');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','cap nhat that bai');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
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
