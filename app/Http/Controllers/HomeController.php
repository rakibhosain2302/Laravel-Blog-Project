<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Copyright;
use App\Models\Page;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Social;
use App\Models\Titleslogan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $perPage = 3;
        $page = request()->query('page', 1);
        $skip = ($page - 1) * $perPage;
        $totalPosts = Post::count();

        $posts = Post::with(['user', 'category'])->skip($skip)->take($perPage)->get();

        return view('index', compact('posts','page', 'perPage', 'totalPosts'));
    }


    public function show(string $id)
    {
        $post = Post::with(['user', 'category'])->findOrFail($id);

        $relatedPost = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $id)
            ->latest()
            ->take(6)
            ->get();

        return view('post', compact('post', 'relatedPost'));
    }


    public function categoryFilter($id)
    {
        $perPage = 3;
        $page = request()->query('page', 1);
        $skip = ($page - 1) * $perPage;
        $totalPosts = Post::where('category_id', $id)->count();
        $posts = Post::where('category_id', $id)->skip($skip)->take($perPage)->get();
        $category = Category::with('posts')->findOrFail($id);
        return view('index', compact('posts', 'category', 'page', 'perPage', 'totalPosts'));
    }



    public function getTitleSlogan(string $id)
    {

        $data = Titleslogan::findOrFail($id);
        return view('admin.pages.titleslogan', compact('data'));
    }




    public function titleSloganUpdate(Request $request, string $id)
    {
        // Validate input data
        $request->validate([
            'title' => 'required|max:100',
            'slogan' => 'required|max:100',
            'logo' => 'nullable|mimes:png,jpg|max:2048',
        ]);

        $update = Titleslogan::findOrFail($id);

        $isTitleSame = $update->title === $request->title;
        $isSloganSame = $update->slogan === $request->slogan;
        $isLogoSame = !$request->hasFile('logo');


        if ($isTitleSame && $isSloganSame && $isLogoSame) {
            return redirect()->back()->with('error', 'Title & Slogan already updated. Please try again.');
        }


        if ($request->hasFile('logo')) {
            if ($update->logo) {
                Storage::disk('public')->delete($update->logo);
            }
            $fileName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $path = $request->file('logo')->storeAs('uploads/logo', $fileName, 'public');
            $update->logo = $path;
        }


        $update->title = $request->title;
        $update->slogan = $request->slogan;
        $update->save();
        return redirect()->back()->with('success', 'Title & Slogan updated successfully!');

    }




    public function getSocialLink(string $id)
    {
        $socials = Social::findOrFail($id);
        return view('admin.pages.social', compact('socials'));
    }


    public function socialUpdate(Request $request, string $id)
    {

        $request->validate([
            'fblink' => 'required|url',
            'twlink' => 'required|url',
            'lnlink' => 'required|url',
            'gllink' => 'required|url',
        ]);

        $update = Social::findOrFail($id);

        $isFblinkSame = $update->fblink === $request->fblink;
        $isTwlinkSame = $update->twlink === $request->twlink;
        $isLnlinkSame = $update->lnlink === $request->lnlink;
        $isGglinkSame = $update->gllink === $request->gllink;


        if ($isFblinkSame && $isTwlinkSame && $isLnlinkSame && $isGglinkSame) {
            return redirect()->back()->with('error', 'Socials Links already updated. Please try again.');
        }


        $update->update([
            'fblink' => $request->fblink,
            'twlink' => $request->twlink,
            'lnlink' => $request->lnlink,
            'gllink' => $request->gllink
        ]);

        return redirect()->back()->with('success', 'Socials Links updated successfully!');
    }

    public function getCopynote(string $id)
    {
        $noteData = Copyright::findOrFail($id);
        return view('admin.pages.copyright', compact('noteData'));
    }

    public function CopyNoteUpdate(Request $request, string $id)
    {

        $request->validate([
            'note' => 'required|max:100'
        ]);

        $update = Copyright::findOrFail($id);

        $isSameNote = $update->note === $request->note;
        if ($isSameNote) {
            return redirect()->back()->with('error', 'Title & Slogan already updated. Please try again.');
        }


        $update->update([
            'note' => $request->note
        ]);

        return redirect()->back()->with('success', 'Socials Links updated successfully!');
    }


    public function singlePage($id)
    {
        $singlePages = Page::findOrFail($id);
        return view('singlepage', compact('singlePages'));
    }

    public function ContractPage()
    {
        return view('contract');
    }

    public function search(Request $request)
    {
        $search = $request->input('keyword');
    
        if (!$search) {
            return redirect()->route('home'); 
        }
    
        $posts = Post::where('title', 'LIKE', "%{$search}%")
                     ->orWhere('discription', 'LIKE', "%{$search}%")
                     ->get();
    
    
        return view('search', compact('posts', 'search'));
    }
    




}
