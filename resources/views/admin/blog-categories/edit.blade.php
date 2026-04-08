@extends('admin.layouts.app')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: auto;">
    <div class="mb-4">
        <h1 class="mb-0">Edit Category</h1>
    </div>

    <form action="{{ route('admin.blog-categories.update', $blogCategory->id) }}" method="POST">
        @csrf @method('PUT')
        
        <div class="mb-4">
            <label class="form-label text-muted small uppercase" style="font-weight: 700;">Category Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $blogCategory->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center pt-3">
            <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; padding: 12px 24px;">Cancel</a>
            <button type="submit" class="btn btn-success px-5" style="border-radius: 12px; padding: 12px 24px;">Update Category</button>
        </div>
    </form>
</div>
@endsection
