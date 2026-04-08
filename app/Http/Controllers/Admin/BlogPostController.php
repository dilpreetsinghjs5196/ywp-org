<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;

use App\Models\BlogCategory;
use App\Models\BlogPostImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')->latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(StoreBlogPostRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        unset($data['gallery']); // remove file array before saving to DB
        $data['is_editors_choice'] = (bool) $request->input('is_editors_choice', false);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('blogs', 'public');
        }

        $post = BlogPost::create($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('blogs/gallery', 'public');
                $post->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blog)
    {
        $categories = BlogCategory::all();
        $blog->load('images');
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blog)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        unset($data['gallery']); // remove file array before saving to DB
        $data['is_editors_choice'] = (bool) $request->input('is_editors_choice', false);

        if ($request->hasFile('photo')) {
            if ($blog->photo) {
                Storage::disk('public')->delete($blog->photo);
            }
            $data['photo'] = $request->file('photo')->store('blogs', 'public');
        }

        $blog->update($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('blogs/gallery', 'public');
                $blog->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->photo) {
            Storage::disk('public')->delete($blog->photo);
        }

        foreach ($blog->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully.');
    }

    public function deleteImage($id)
    {
        $image = BlogPostImage::findOrFail($id);
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
