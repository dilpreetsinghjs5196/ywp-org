@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="mb-4">
        <h1 class="mb-0">Edit Blog Post</h1>
    </div>

    <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        
        <div class="row">
            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Blog Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" style="height: 400px;" required>{{ old('content', $blog->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Category</label>
                    <select name="blog_category_id" class="form-select @error('blog_category_id') is-invalid @enderror" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('blog_category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Thumbnail Photo</label>
                    @if($blog->photo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $blog->photo) }}" width="150" height="100" style="object-fit: cover; border-radius: 8px;">
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                    <small class="text-muted">Leave empty to keep current photo</small>
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Gallery Photos (Multiple)</label>
                    <div class="row g-2 mb-2">
                        @foreach($blog->images as $image)
                            <div class="col-4 position-relative">
                                <img src="{{ asset('storage/' . $image->image) }}" class="w-100 rounded" style="height: 60px; object-fit: cover;">
                                <a href="{{ route('admin.blog.delete-image', $image->id) }}" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-1" border-radius="50%" onclick="return confirm('Delete this image?')">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <input type="file" name="gallery[]" class="form-control @error('gallery.*') is-invalid @enderror" multiple>
                    <small class="text-muted">Upload more images to the gallery</small>
                    @error('gallery.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Author</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $blog->author) }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Published At</label>
                    <input type="date" name="published_at" class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at', $blog->published_at->format('Y-m-d')) }}" required>
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Tags</label>
                    <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror" placeholder="mental health, support, etc." value="{{ old('tags', $blog->tags) }}">
                    @error('tags')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="publish" {{ old('status', $blog->status) == 'publish' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_editors_choice" id="editIsEditorsChoice" value="1" {{ old('is_editors_choice', $blog->is_editors_choice) ? 'checked' : '' }}>
                        <label class="form-check-label text-muted small uppercase" style="font-weight: 700;" for="editIsEditorsChoice">Editor's Choice</label>
                    </div>
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center pt-3 mt-4 border-top">
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; padding: 12px 24px;">Cancel</a>
            <button type="submit" class="btn btn-success px-5" style="border-radius: 12px; padding: 12px 24px;">Update Blog Post</button>
        </div>
    </form>
</div>
@endsection
