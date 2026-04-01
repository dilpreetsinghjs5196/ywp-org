@extends('admin.layouts.app')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Gallery Manager</h1>
        <a href="{{ route('admin.gallery.create') }}" class="btn-premium">
            <i class="fa fa-plus"></i> Add New Image
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="border-radius: 12px; border: none; background: rgba(40, 167, 69, 0.1); color: #28a745;">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-2">
        @foreach($images as $img)
        <div class="col">
            <div class="item-card bg-white h-100 shadow-sm" style="border-radius: 15px; overflow: hidden; border: 1px solid rgba(0,0,0,0.05);">
                <div class="position-relative">
                    @php
                        $imgPath = $img->image;
                        if ($imgPath && !str_starts_with($imgPath, 'uploads/')) {
                            $imgPath = 'images/gallery/' . $imgPath;
                        }
                    @endphp
                    <img src="{{ asset($imgPath) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 p-2 w-100 bg-gradient-dark text-white text-center small" style="background: linear-gradient(transparent, rgba(0,0,0,0.7))">
                        {{ $img->title ?? 'Untitled' }}
                    </div>
                </div>
                <div class="p-3 d-flex justify-content-between align-items-center">
                    <span class="badge {{ $img->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $img->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.gallery.edit', $img->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.gallery.destroy', $img->id) }}" method="POST" onsubmit="return confirm('Remove this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($images->isEmpty())
        <div class="text-center py-5 text-muted">
             <i class="fa fa-image fa-3x mb-3 opacity-25"></i>
             <p>No images found in the gallery. Upload your first one!</p>
        </div>
    @endif
</div>
@endsection
