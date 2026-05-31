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
        $totalPosts = 0;
        $posts = collect();

        try {
            $totalPosts = Post::count();
            $posts = Post::with(['user', 'category'])->skip($skip)->take($perPage)->get();
        } catch (\Throwable $e) {
            // Fall back to an empty homepage when the database is unavailable.
        }

        return view('index', compact('posts', 'page', 'perPage', 'totalPosts'));
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


    public function titleSlogan()
    {
        $data = Titleslogan::orderByDesc('id')->get();
        return view('admin.pages.blogtitle.index', compact('data'));
    }

    public function titleSloganStore(Request $request)
    {
        if (Titleslogan::exists()) {
            return redirect()->route('blog.title.index')
                ->with('error', 'A blog title already exists. Please update the existing one instead.');
        }

        $request->validate([
            'title' => 'required|max:100',
            'slogan' => 'required|max:100',
            'logo' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('logo')) {
            $fileName = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $path = $request->file('logo')->storeAs('uploads/logo', $fileName, 'public');
        }

        Titleslogan::create([
            'title' => $request->title,
            'slogan' => $request->slogan,
            'logo' => $path,
        ]);

        return redirect()->route('blog.title.index')->with('success', 'Blog title added successfully!');
    }



    public function getTitleSlogan(string $id)
    {
        $data = Titleslogan::findOrFail($id);
        return view('admin.pages.blogtitle.edit', compact('data'));
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

    public function titleSloganDelete(string $id)
    {
        $delete = Titleslogan::findOrFail($id);
        if ($delete->logo) {
            Storage::disk('public')->delete($delete->logo);
        }
        $delete->delete();
        return redirect()->route('blog.title.index')->with('success', 'Blog title deleted successfully!');
    }

    public function socialIndex()
    {
        $data = Social::orderByDesc('id')->get();
        return view('admin.pages.sociallink.index', compact('data'));
    }

    public function socialStore(Request $request)
    {
        if (Social::exists()) {
            return redirect()->route('social.index')
                ->with('error', 'Social media links already exist. Please update the existing record instead.');
        }

        $request->validate([
            'fblink' => 'required|url',
            'twlink' => 'required|url',
            'lnlink' => 'required|url',
            'gllink' => 'required|url',
        ]);

        Social::create([
            'fblink' => $request->fblink,
            'twlink' => $request->twlink,
            'lnlink' => $request->lnlink,
            'gllink' => $request->gllink,
        ]);

        return redirect()->route('social.index')->with('success', 'Social media links added successfully!');
    }

    public function socialDelete(string $id)
    {
        Social::findOrFail($id)->delete();

        return redirect()->route('social.index')->with('success', 'Social media links deleted successfully!');
    }




    public function getSocialLink(string $id)
    {
        $socials = Social::findOrFail($id);
        return view('admin.pages.sociallink.edit', compact('socials'));
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

    public function copyrightIndex()
    {
        $data = Copyright::orderByDesc('id')->get();
        return view('admin.pages.copyright.copyright', compact('data'));
    }

    public function copyrightStore(Request $request)
    {
        if (Copyright::exists()) {
            return redirect()->route('copyright.index')
                ->with('error', 'Copyright text already exists. Please update the existing record instead.');
        }

        $request->validate([
            'note' => 'required|max:100',
        ]);

        Copyright::create([
            'note' => $request->note,
        ]);

        return redirect()->route('copyright.index')->with('success', 'Copyright text added successfully!');
    }

    public function getCopynote(string $id)
    {
        $noteData = Copyright::findOrFail($id);
        return view('admin.pages.copyright.edit', compact('noteData'));
    }

    public function CopyNoteUpdate(Request $request, string $id)
    {
        $request->validate([
            'note' => 'required|max:100',
        ]);

        $update = Copyright::findOrFail($id);

        $isSameNote = $update->note === $request->note;
        if ($isSameNote) {
            return redirect()->back()->with('error', 'Copyright text already updated. Please try again.');
        }


        $update->update([
            'note' => $request->note,
        ]);

        return redirect()->back()->with('success', 'Copyright text updated successfully!');
    }

    public function copyrightDelete(string $id)
    {
        Copyright::findOrFail($id)->delete();

        return redirect()->route('copyright.index')->with('success', 'Copyright text deleted successfully!');
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
