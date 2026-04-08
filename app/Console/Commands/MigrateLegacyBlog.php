<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MigrateLegacyBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-legacy-blog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate blog data from legacy system to Laravel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting migration...');

        try {
            $pdo = \DB::connection()->getPdo();
        } catch (\Exception $e) {
            $this->error('Connection failed: ' . $e->getMessage());
            return 1;
        }

        // Clear existing Laravel data
        \Schema::disableForeignKeyConstraints();
        BlogPost::truncate();
        BlogCategory::truncate();

        // Ensure we handle 'Uncategorized'
        $uncategorized = BlogCategory::firstOrCreate(
            ['slug' => 'uncategorized'],
            ['name' => 'Uncategorized']
        );
        $defaultCatId = $uncategorized->id;

        // 1. Migrate Categories
        $this->info('Migrating Categories...');
        $stmt = $pdo->query("SELECT * FROM blog_categories");
        
        $categoriesMap = [];
        
        // Manual mapping for IDs discovered via analysis
        $manualMapping = [
            9 => 'Mental Health',
            10 => 'Disability',
            11 => 'Bullying',
            13 => 'Gender and Sexuality',
            14 => 'Society',
            15 => 'Domestic Violence'
        ];

        foreach ($manualMapping as $oldId => $name) {
            $cat = BlogCategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
            $categoriesMap[$oldId] = $cat->id;
        }

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $slug = Str::slug($row['name']);
            $category = BlogCategory::firstOrCreate(
                ['slug' => $slug],
                ['name' => $row['name']]
            );
            $categoriesMap[$row['id']] = $category->id;
        }

        // 2. Migrate Posts
        $this->info('Migrating Posts...');
        try {
            $stmt = $pdo->query("SELECT * FROM blogs");
        } catch (\Exception $e) {
            $this->error('Failed to query blogs: ' . $e->getMessage());
            return 1;
        }

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $photo = null;
            if (!empty($row['photo'])) {
                $photo = 'blogs/' . $row['photo'];
            }

            BlogPost::create([
                'blog_category_id' => $categoriesMap[$row['category']] ?? $defaultCatId,
                'title' => $row['title'],
                'slug' => Str::slug($row['title']) . '-' . $row['id'],
                'author' => $row['author'] ?: 'Admin',
                'photo' => $photo,
                'published_at' => $row['date'] ?: now(),
                'tags' => $row['tags'],
                'content' => $row['content'],
                'status' => 'publish',
                'is_editors_choice' => false,
                'views' => 0
            ]);
        }

        \Schema::enableForeignKeyConstraints();

        // 3. Handle Editor's Choice if table exists
        $this->info('Checking Editor\'s Choice...');
        try {
            $stmt = $pdo->query("SELECT * FROM editors_choice");
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $post = BlogPost::where('title', 'LIKE', '%' . $row['blog'] . '%')->first();
                if ($post) {
                    $post->update(['is_editors_choice' => true]);
                }
            }
        } catch (\Exception $e) {
            $this->warn('Editor\'s Choice migration skipped or failed.');
        }

        $this->info('Migration completed successfully!');
    }
}
