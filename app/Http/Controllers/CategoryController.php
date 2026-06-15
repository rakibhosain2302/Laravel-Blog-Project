<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        // Only Admin and Editor can access Inbox
        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }

        $catData = Category::withCount('posts')->latest()->get();
        $editCategory = request()->filled('edit_id') ? Category::find(request('edit_id')) : null;

        return view('admin.pages.categories.index', compact('catData', 'editCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        // Only Admin and Editor can access Inbox
        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }

        return view('admin.pages.categories.create');
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
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        // Only Admin and Editor can access Inbox
        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }

        return redirect()->route('categories.index', ['edit_id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        // Only Admin and Editor can access Inbox
        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $id,
        ], [
            'name.required' => 'Category name is required.',
            'name.unique' => 'This category name already exists.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('categories.index', ['edit_id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

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
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        // Only Admin and Editor can access Inbox
        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
