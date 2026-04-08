<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BlogPost;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        $latestPosts = BlogPost::with('category')->where('status', 'publish')->latest()->take(3)->get();
        $gridPosts = BlogPost::with('category')->where('status', 'publish')->latest()->paginate(8);
        $editorsChoice = BlogPost::where('status', 'publish')->where('is_editors_choice', true)->latest()->take(8)->get();
        $categories = BlogCategory::withCount(['posts' => function($query) {
            $query->where('status', 'publish');
        }])->get();
        $olderPosts = BlogPost::where('status', 'publish')->oldest()->take(8)->get();

        return view('blog.index', compact('latestPosts', 'gridPosts', 'editorsChoice', 'categories', 'olderPosts'));
    }

    public function show($slug)
    {
        $post = BlogPost::with(['category', 'images'])->where('slug', $slug)->firstOrFail();
        
        // Update views
        $post->increment('views');

        $categories = BlogCategory::withCount(['posts' => function($query) {
            $query->where('status', 'publish');
        }])->get();
        $editorsChoice = BlogPost::where('status', 'publish')->where('is_editors_choice', true)->latest()->take(5)->get();

        return view('blog.show', compact('post', 'categories', 'editorsChoice'));
    }

    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $posts = BlogPost::where('blog_category_id', $category->id)->where('status', 'publish')->latest()->paginate(10);
        $categories = BlogCategory::withCount(['posts' => function($query) {
            $query->where('status', 'publish');
        }])->get();

        return view('blog.category', compact('category', 'posts', 'categories'));
    }
}
