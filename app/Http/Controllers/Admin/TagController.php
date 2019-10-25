<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->get();
        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
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
            'name' => 'required|min:3|max:100|unique:tags'
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);

        Toastr::success('Tag created successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.tag.index');
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
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', ['tag'=>$tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'sometimes|required|min:3|max:100'
        ]);

        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();

        Toastr::success('Tag updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        Toastr::success('Tag deleted successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
