@extends('admin.layouts.app')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Gallery Image</h1>
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

    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row g-4">
            <div class="col-md-6 text-center text-md-start">
                <label class="form-label text-muted small d-block">Current Image Preview</label>
                @php
                    $imgPath = $gallery->image;
                    if ($imgPath && !str_starts_with($imgPath, 'uploads/')) {
                        $imgPath = 'images/gallery/' . $imgPath;
                    }
                @endphp
                <img src="{{ asset($imgPath) }}" height="200" style="border-radius: 15px; border: 3px solid #fed700; object-fit: cover;">
            </div>
            
            <div class="col-md-6 d-flex flex-column gap-3 justify-content-center">
                 <div class="col-12">
                     <label class="form-label text-muted small">Update Image (Optional)</label>
                     <input type="file" name="image" class="form-control">
                     <small class="text-muted">Upload a new image to replace the current one.</small>
                 </div>
                 
                 <div class="row g-2">
                     <div class="col-6">
                         <label class="form-label text-muted small">Sort Order</label>
                         <input type="number" name="sort_order" class="form-control" value="{{ $gallery->sort_order ?? 0 }}">
                     </div>
                     <div class="col-6">
                         <label class="form-label text-muted small">Active Status</label>
                         <select name="is_active" class="form-control">
                            <option value="1" @if($gallery->is_active) selected @endif>Active</option>
                            <option value="0" @if(!$gallery->is_active) selected @endif>Draft</option>
                         </select>
                     </div>
                 </div>
            </div>

            <div class="col-md-12 mt-4">
                <label class="form-label text-muted small">Title / Caption (Optional)</label>
                <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" placeholder="Enter image title or category">
            </div>
        </div>

        <div class="mt-5 pt-4 border-top">
            <button type="submit" class="btn-premium px-5">
                <i class="fa fa-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
