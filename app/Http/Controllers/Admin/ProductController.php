<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::latest()->get();
        return view('admin.allproduct', compact('products'));
    }

    public function addproduct()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        return view('admin.addproduct', compact('categories', 'subcategories'));
    }

    public function storeproduct(Request $request)
    {

        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = SubCategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::create([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_img' =>  $img_url,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace('', '-', $request->product_name)),
        ]);

        Category::where('id', $category_id)->increment('product_count', 1);
        SubCategory::where('id', $subcategory_id)->increment('product_count', 1);

        return redirect()->route('allproduct')->with('message', 'product added successfuly!');
    }

    public function editproductimg($id)
    {
        $productinfo = Product::findOrFail($id);
        return view('admin.editproductimg', compact('productinfo'));
    }

    public function updateproductimg(Request $request)
    {
        $request->validate([
            'product_img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $id = $request->id;
        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        Product::findOrFail($id)->update([
            'product_img' =>  $img_url,
        ]);

        return redirect()->route('allproduct')->with('message', 'product image updated successfuly!');
    }

    public function edit($id)

    {
        $productinfo = Product::find($id);
        return view('admin.edit', compact('productinfo'));
    }

    public function updateproduct(Request $request)
    {
        $productid = $request->id;

        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
        ]);

        Product::findOrFail($productid)->update([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace('', '-', $request->product_name)),
        ]);
        return redirect()->route('allproduct')->with('message', 'product updated successfuly!');
    }

    public function deletepro($id)
    {

        $cat_id = product::where('id', $id)->value('product_category_id');
        $subcat_id = product::where('id', $id)->value('product_subcategory_id');

        Product::findOrFail($id)->delete();

        category::where('id', $cat_id)->decrement('product_count', 1);
        SubCategory::where('id', $subcat_id)->decrement('product_count', 1);

        return redirect()->route('allproduct')->with('message', 'deleted successfuly!');
    }
}
