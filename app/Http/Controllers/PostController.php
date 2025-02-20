<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if (in_array($user->role->name ,['Admin','Editor'])) {
            // শুধুমাত্র Admin সব পোস্ট দেখতে পারবে
            $posts = Post::with(['user', 'category'])->latest()->get();
            $postCount = Post::count();
        } else {
            // Editor, User, Guest শুধুমাত্র নিজের পোস্ট দেখতে পারবে
            $posts = Post::where('user_id', $user->id)->with(['user', 'category'])->latest()->get();
            $postCount = $posts->count();
        }

        return view('admin.pages.postlist', compact('posts', 'postCount'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.addpost', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required',
            'images' => 'required|mimes:png,jpg,jpeg|max:2048',
            'discription' => 'required',
            'tags' => 'required|max:50',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ]);

        // Check if image exists
        if ($request->hasFile('images')) {
            $path = $request->file('images')->store('uploads', 'public');
        } else {
            return back()->with('error', 'Image upload failed!');
        }

        // Create post
        Post::create([
            'title' => $request->title,
            'images' => $path,
            'discription' => $request->discription,
            'tags' => $request->tags,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id
        ]);

        // return $post;

        return redirect()->route('posts.index')->with('success', 'Post Uploaded Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $viewPost = Post::with(['user', 'category'])->findOrFail($id);
        return view('admin.pages.viewpost', compact('viewPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $updatePost = Post::with(['user', 'category'])->findOrFail($id);
        $categories = Category::all();
        return view('admin.pages.postUpdate', compact('updatePost', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate request data
        $request->validate([
            'title' => 'required|string|max:255',
            'images' => 'nullable|mimes:png,jpg,jpeg|max:2048', // Optional image
            'discription' => 'required|string',
            'tags' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Find the post
        $update = Post::findOrFail($id);

        // Check if new image is uploaded
        if ($request->hasFile('images')) {
            // Delete old image
            if ($update->images) {
                $filePath = public_path('storage/' . $update->images);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }

            // Upload new image
            $path = $request->file('images')->store('uploads', 'public');
            $update->images = $path;
        }

        // Update post data
        $update->title = $request->title;
        $update->category_id = $request->category_id;
        $update->discription = $request->discription;
        $update->tags = $request->tags;
        $update->save();

        return redirect()->route('posts.index')->with('success', 'Post Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        $filePath = public_path('storage/') . $post->images;

        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post Deleted Successfully');
    }
}
