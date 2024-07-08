<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $pageTitle     = "All Subcategories";
        $subCategories = SubCategory::searchable(['name', 'category:name'])->with('category')->orderBy('name')->paginate(getPaginate());
        return view('admin.subcategory.index', compact('pageTitle', 'subCategories'));
    }
    public function create()
    {
        $pageTitle  = "Create Subcategory";
        $categories = Category::active()->orderBy('name')->with('subcategory')->get();
        $subCategories = SubCategory::whereNull('sub_parent_id')->active()->orderBy('name')->with('parentSubcategory')->get();


        return view('admin.subcategory.create', compact('pageTitle', 'categories', 'subCategories'));

    }

    public function store(Request $request, $id = 0)
    {
        $request->validate([
            "name"          => 'required|max:40',
            "category_id"   => 'required|exists:categories,id',
            'sub_parent_id' => 'nullable|numeric',
            "description"   => 'required',
            "image"         => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        if ($id) {
            $subcategory = SubCategory::findOrFail($id);
            $message     = "Subcategory updated successfully";
        } else {
            $subcategory = new SubCategory();
            $message     = "Subcategory added successfully";
        }

        if ($request->hasFile('image')) {
            try {
                $old                = $subcategory->image;
                $subcategory->image = fileUploader($request->image, getFilePath('subcategory'), getFileSize('subcategory'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $subcategory->name        = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->sub_parent_id = $request->sub_parent_id;
        $subcategory->description = $request->description;
        $subcategory->save();

        $notify[] = ["success", $message];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        return SubCategory::changeStatus($id);
    }

    public function edit($id)
    {
        $pageTitle   = "Edit Subcategory";
        $categories  = Category::active()->get();
        $subCategories = SubCategory::active()->get();
        $subcategory = SubCategory::findOrFail($id);
        return view("admin.subcategory.create", compact('pageTitle', 'subcategory', 'categories', 'subCategories'));
    }
}
