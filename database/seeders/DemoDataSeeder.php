<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contract;
use App\Models\Copyright;
use App\Models\Page;
use App\Models\Post;
use App\Models\Role;
use App\Models\Slider;
use App\Models\Social;
use App\Models\Titleslogan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Contract::query()->truncate();
        Post::query()->truncate();
        Category::query()->truncate();
        Page::query()->truncate();
        Slider::query()->truncate();
        Titleslogan::query()->truncate();
        Copyright::query()->truncate();
        Social::query()->truncate();

        Schema::enableForeignKeyConstraints();

        $roles = collect([
            ['name' => 'Guest', 'description' => 'Default visitor role'],
            ['name' => 'Admin', 'description' => 'Full access to the system'],
            ['name' => 'Editor', 'description' => 'Can manage posts and pages'],
            ['name' => 'User', 'description' => 'Regular authenticated user'],
        ])->map(function (array $role) {
            return Role::firstOrCreate(
                ['name' => $role['name']],
                ['description' => $role['description']]
            );
        })->keyBy('name');

        $users = User::query()->orderBy('id')->get();

        if ($users->isEmpty()) {
            $users = collect([
                ['name' => 'Admin User', 'email' => 'admin@demo.test', 'role' => 'Admin'],
                ['name' => 'Editor User', 'email' => 'editor@demo.test', 'role' => 'Editor'],
                ['name' => 'Writer User', 'email' => 'writer@demo.test', 'role' => 'User'],
                ['name' => 'Guest User', 'email' => 'guest@demo.test', 'role' => 'Guest'],
            ])->map(function (array $user) use ($roles) {
                return User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => 'password',
                    'role_id' => $roles[$user['role']]->id,
                ]);
            })->values();
        }

        $categories = collect([
            'Laravel Tips',
            'PHP Basics',
            'Web Design',
            'Productivity',
            'Tech News',
        ])->map(fn (string $name) => Category::create(['name' => $name]))->values();

        $this->copyPublicAsset('assets/images/logo.png', 'uploads/logo/site-logo.png');

        Titleslogan::create([
            'title' => 'Laravel Blog',
            'slogan' => 'Clean stories, practical tips, and useful updates',
            'logo' => 'uploads/logo/site-logo.png',
        ]);

        collect([
            ['title' => 'Build faster with Laravel', 'source' => 'assets/images/slideshow/01.jpg'],
            ['title' => 'Write cleaner PHP', 'source' => 'assets/images/slideshow/02.jpg'],
            ['title' => 'Design with intention', 'source' => 'assets/images/slideshow/03.jpg'],
            ['title' => 'Ship useful content', 'source' => 'assets/images/slideshow/04.jpg'],
        ])->each(function (array $slider, int $index) {
            $path = sprintf('uploads/sliders/slider-%d.jpg', $index + 1);
            $this->copyPublicAsset($slider['source'], $path);

            Slider::create([
                'title' => $slider['title'],
                'image' => $path,
            ]);
        });

        collect([
            ['name' => 'About Us', 'body' => 'We publish practical tutorials, project notes, and short updates for everyday builders.'],
            ['name' => 'Services', 'body' => 'This demo site is designed to show how a simple Laravel CMS can present articles, pages, and contact messages.'],
            ['name' => 'Privacy Policy', 'body' => 'Demo content only. Replace this page with your real privacy policy before publishing the site publicly.'],
            ['name' => 'FAQ', 'body' => 'Frequently asked questions can live here to help readers quickly understand the site and its content.'],
        ])->each(fn (array $page) => Page::create($page));

        Copyright::create([
            'note' => 'All rights reserved. Demo content for ',
        ]);

        Social::create([
            'fblink' => 'https://facebook.com/',
            'twlink' => 'https://x.com/',
            'lnlink' => 'https://linkedin.com/',
            'gllink' => 'https://www.google.com/',
        ]);

        $postImages = [
            'assets/images/post1.jpg',
            'assets/images/post2.png',
            'assets/images/about.jpg',
            'assets/images/tcl.jpg',
        ];

        collect(range(1, 12))->each(function (int $number) use ($categories, $users, $postImages) {
            $imageSource = $postImages[($number - 1) % count($postImages)];
            $imagePath = sprintf('uploads/posts/post-%02d.%s', $number, pathinfo($imageSource, PATHINFO_EXTENSION));

            $this->copyPublicAsset($imageSource, $imagePath);

            Post::create([
                'title' => 'Demo Post ' . $number,
                'images' => $imagePath,
                'discription' => 'This is demo content for post ' . $number . '. ' . fake()->paragraphs(2, true),
                'tags' => implode(', ', [
                    'laravel',
                    'php',
                    Str::slug($categories->random()->name),
                ]),
                'category_id' => $categories->random()->id,
                'user_id' => $users->random()->id,
            ]);
        });

        collect(range(1, 6))->each(function (int $number) {
            Contract::create([
                'firstname' => fake()->firstName(),
                'lastname' => fake()->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'message' => fake()->paragraphs(3, true),
                'is_seen' => $number % 2 === 0,
            ]);
        });
    }

    private function copyPublicAsset(string $sourceRelativePath, string $targetRelativePath): void
    {
        $sourcePath = public_path($sourceRelativePath);

        if (! is_file($sourcePath)) {
            return;
        }

        Storage::disk('public')->put($targetRelativePath, file_get_contents($sourcePath));
    }
}
