@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="mb-4">
        <h1 class="mb-0">Add New Post</h1>
    </div>

    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Blog Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter post title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" style="height: 400px;" placeholder="Start writing..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Category</label>
                    <select name="blog_category_id" class="form-select @error('blog_category_id') is-invalid @enderror" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('blog_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('blog_category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Thumbnail Photo</label>
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Gallery Photos (Multiple)</label>
                    <input type="file" name="gallery[]" class="form-control @error('gallery.*') is-invalid @enderror" multiple>
                    @error('gallery.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Author</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', 'Admin') }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Published At</label>
                    <input type="date" name="published_at" class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at', date('Y-m-d')) }}" required>
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish Now</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Save as Draft</option>
                    </select>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_editors_choice" id="isEditorsChoice" value="1" {{ old('is_editors_choice') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted small uppercase" style="font-weight: 700;" for="isEditorsChoice">Editor's Choice</label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small uppercase" style="font-weight: 700;">Tags</label>
                    <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror" placeholder="mental health, support, etc." value="{{ old('tags') }}">
                    @error('tags')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center pt-3 mt-4 border-top">
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; padding: 12px 24px;">Cancel</a>
            <button type="submit" class="btn btn-success px-5" style="border-radius: 12px; padding: 12px 24px;">Create Blog Post</button>
        </div>
    </form>
</div>
@endsection
