<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|min:3|max:100|unique:categories',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,PNG'
        ]);
        
        // get form image
        $image = $request->file('image');
        $slug  = str_slug($request->name);

        if (isset($image)) {
            // make unique name
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // check category directory is exist
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            // image resize 
            $categoryImage = Image::make($image)->resize(1600, 479)->save();
            Storage::disk('public')->put('category/' . $imageName, $categoryImage);


            // check category slider directory is exist
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // image resize 
            $categoryImage = Image::make($image)->resize(500, 333)->save();
            Storage::disk('public')->put('category/slider/' . $imageName, $categoryImage);

            Category::create([
                'name'  => $request->name,
                'slug'  => $slug,
                'image' => $imageName
            ]);
    
            Toastr::success('Category created successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('admin.category.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|min:3|max:100',
            'image' => 'mimes:jpg,jpeg,png,bmp,PNG'
        ]);
        
        // get form image
        $image = $request->file('image');
        $slug  = str_slug($request->name);

        $oldImageName = $category->image;

        if (isset($image)) {
            // make unique name
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // check category directory is exist
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            // check category image is exist then delete image
            if (Storage::disk('public')->exists('category/' . $oldImageName)) {
                Storage::disk('public')->delete('category/' . $oldImageName);
            }
            // check category image is exist then delete image
            if (Storage::disk('public')->exists('category/slider/' . $oldImageName)) {
                Storage::disk('public')->delete('category/slider/' . $oldImageName);
            }

            // image resize 
            $categoryImage = Image::make($image)->resize(1600, 479)->save();
            Storage::disk('public')->put('category/' . $imageName, $categoryImage);


            // check category slider directory is exist
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            // image resize 
            $categoryImage = Image::make($image)->resize(500, 333)->save();
            Storage::disk('public')->put('category/slider/' . $imageName, $categoryImage);

            
            $category->name = $request->name;
            $category->slug = $slug;
            $category->image = $imageName;
            $category->save();
        } else {
            $category->name = $request->name;
            $category->slug = $slug;
            $category->save();
        }

        Toastr::success('Category updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $oldImageName = $category->image;

        // check category image is exist then delete image
        if (Storage::disk('public')->exists('category/' . $oldImageName)) {
            Storage::disk('public')->delete('category/' . $oldImageName);
        }
        
        // check category image is exist then delete image
        if (Storage::disk('public')->exists('category/slider/' . $oldImageName)) {
            Storage::disk('public')->delete('category/slider/' . $oldImageName);
        }

        $category->delete();
        Toastr::success('Category deleted successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
