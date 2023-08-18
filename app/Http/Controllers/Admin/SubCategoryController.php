<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $allsubcategories = SubCategory::latest()->get();
        return view('admin.allsubcategory', compact('allsubcategories'));
    }

    public function addsubcategory()
    {
        $categories = Category::latest()->get();
        return view('admin.addsubcategory', compact('categories'));
    }

    public function storesubcategory(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories',
            'category_id' => 'required'
        ]);


        $category_id = $request->category_id;

        $category_name = Category::where('id', $category_id)->value('category_name');


        SubCategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace('', '-', $request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name
        ]);


        Category::where('id', $category_id)->increment('subcategory_count', 1);

        return redirect()->route('allsubcategory')->with('message', 'added successfuly!');
    }

    public function editsubcat($id)
    {
        $subcatinfo = SubCategory::findOrFail($id);
        return view('admin.editsubcat', compact('subcatinfo'));
    }

    public function updatesubcat(Request $request)
    {

        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories',
        ]);

        $subcatid = $request->subcatid;
        SubCategory::findOrFail($subcatid)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace('', '-', $request->subcategory_name)),
        ]);

        return redirect()->route('allsubcategory')->with('message', 'updated successfuly!');
    }

    public function deletesubcat($id)
    {
        $cat_id = SubCategory::where('id', $id)->value('category_id');
        SubCategory::findOrFail($id)->delete();
        category::where('id', $cat_id)->decrement('subcategory_count', 1);

        return redirect()->route('allsubcategory')->with('message', 'deleted successfuly!');
    }
}
