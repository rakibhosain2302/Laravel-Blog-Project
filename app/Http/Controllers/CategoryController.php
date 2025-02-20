<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catData = Category::withCount('posts')->latest()->get();
        return view('admin.pages.catlist', compact('catData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.addcat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $addcat = $request->validate([
            'name' => 'required|unique:categories,name'
        ], [
            'name.unique'
        ]);

        Category::create($addcat);

        return redirect()->route('categories.index')->with('success', 'Cotegory Add Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $catSelect = Category::findOrFail($id);

        return view('admin.pages.catUpdate', compact('catSelect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id
        ], [
            'name.unique'
        ]);

        $update = Category::findOrFail($id);
        $update->update([
            'name' => $request->name
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }

}
