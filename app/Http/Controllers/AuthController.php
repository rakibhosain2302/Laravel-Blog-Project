<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contract;
use App\Models\Page;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Social;
use App\Models\Titleslogan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function admin()
    {
        if (Auth::check()) {
            return redirect()->route('dashbord');
        }
        return redirect()->route('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'

        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
        ]);

        return redirect()->route('auth.login')->with('success', 'Registration successful! Please login.');
    }


    public function loginUser(Request $request)
    {

        $dataMatching = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($dataMatching)) {
            return redirect()->route('dashbord');
        } else {
            return back()->with('error', 'Invalid email or password!.');
        }
    }

    public function dashboard()
    {
        $user = Auth::user();
        $roleName = optional($user->role)->name ?? 'Guest';
        $siteBrand = Titleslogan::first();

        $dashboardStats = [
            [
                'label' => 'Total Posts',
                'value' => Post::count(),
                'note' => 'Published articles across the site',
                'accent' => 'linear-gradient(135deg, #0ea5e9, #22d3ee)',
                'dot' => '#0ea5e9',
            ],
            [
                'label' => 'Categories',
                'value' => Category::count(),
                'note' => 'Content groups and topics',
                'accent' => 'linear-gradient(135deg, #8b5cf6, #d946ef)',
                'dot' => '#8b5cf6',
            ],
            [
                'label' => 'Pages',
                'value' => Page::count(),
                'note' => 'Static information pages',
                'accent' => 'linear-gradient(135deg, #f59e0b, #fb923c)',
                'dot' => '#f59e0b',
            ],
            [
                'label' => 'Users',
                'value' => User::count(),
                'note' => 'Registered admin and editors',
                'accent' => 'linear-gradient(135deg, #10b981, #2dd4bf)',
                'dot' => '#10b981',
            ],
            [
                'label' => 'Unread Messages',
                'value' => Contract::where('is_seen', false)->count(),
                'note' => 'Pending inbox conversations',
                'accent' => 'linear-gradient(135deg, #f43f5e, #fb7185)',
                'dot' => '#f43f5e',
            ],
            [
                'label' => 'Branding Items',
                'value' => collect([
                    Titleslogan::count(),
                    Social::count(),
                    Slider::count(),
                ])->sum(),
                'note' => 'Title, socials, and sliders',
                'accent' => 'linear-gradient(135deg, #1e293b, #64748b)',
                'dot' => '#1e293b',
            ],
        ];

        $recentPosts = Post::with(['user', 'category'])
            ->latest()
            ->take(4)
            ->get();

        $recentMessages = Contract::latest()
            ->take(4)
            ->get();

        $quickActions = [
            ['label' => 'Add Post', 'route' => route('posts.create'), 'tone' => 'primary'],
            ['label' => 'View Inbox', 'route' => route('message.index'), 'tone' => 'dark'],
            ['label' => 'Manage Users', 'route' => route('users.index'), 'tone' => 'soft'],
            ['label' => 'Site Settings', 'route' => route('blog.title.index'), 'tone' => 'ghost'],
        ];

        return view('admin.dashbord', compact(
            'user',
            'roleName',
            'siteBrand',
            'dashboardStats',
            'recentPosts',
            'recentMessages',
            'quickActions'
        ));
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
