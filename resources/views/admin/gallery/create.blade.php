@extends('admin.layouts.app')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Gallery Image</h1>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="border-radius: 12px; border: none; background: rgba(220, 53, 69, 0.1); color: #dc3545;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label text-muted small">Title (Optional)</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter image title or category">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small">Active Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" selected>Active</option>
                    <option value="0">Draft</option>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label text-muted small">Select Image File</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <small class="text-muted">Recommended: High-quality JPG/PNG, Max 5MB</small>
            </div>
        </div>

        <div class="mt-5 pt-4 border-top">
            <button type="submit" class="btn-premium px-5">
                <i class="fa fa-upload"></i> Upload Image
            </button>
        </div>
    </form>
</div>
@endsection
