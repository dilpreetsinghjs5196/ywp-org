<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Mental Health Awareness',
            'Peer Support',
            'Wellness & Lifestyle',
            'Community Stories'
        ];

        foreach ($categories as $cat) {
            $category = BlogCategory::create([
                'name' => $cat,
                'slug' => Str::slug($cat)
            ]);

            // Create 3 posts for each category
            for ($i = 1; $i <= 3; $i++) {
                $title = "Sample " . $cat . " Post " . $i;
                BlogPost::create([
                    'blog_category_id' => $category->id,
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'author' => 'YWP Admin',
                    'photo' => null, // Placeholder or existing image path if known
                    'published_at' => now()->subDays(rand(1, 30)),
                    'tags' => 'mentalhealth, support, ' . strtolower(str_replace(' ', '', $cat)),
                    'content' => "This is a sample blog post for " . $cat . ". It discusses the importance of mental health and how the You're Wonderful Project is making a difference in the community.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                    'status' => 'publish',
                    'is_editors_choice' => ($i == 1),
                    'views' => rand(10, 500)
                ]);
            }
        }
    }
}
