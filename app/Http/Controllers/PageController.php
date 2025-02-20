<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.pagelist',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.addpage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $addPage = $request->validate([
            'name' => 'required|max:50',
            'body' => 'required'
        ]);

        Page::create($addPage);

        return redirect()->route('page.index')->with('success', 'Page Add Successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $showData = Page::findOrFail($id);
        return view('admin.pages.viewpage',compact('showData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editPage = Page::findOrFail($id);
        return view('admin.pages.updatePage', compact('editPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:60',
            'body' => 'required'
        ]);

        $update = Page::findOrFail($id);
        $update->update([
            'name' => $request->name,
            'body' => $request->body
        ]);

        return redirect()->route('page.index')->with('success','Page Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect()->route('page.index')->with('success','Page Deleted Successfully');
    }
}
