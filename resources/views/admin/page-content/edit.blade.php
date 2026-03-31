@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.page-content.index') }}" style="color: var(--accent-orange);">Home Content</a></li>
                    <li class="breadcrumb-item text-capitalize" style="color: var(--text-muted);">{{ str_replace('_', ' ', $section) }}</li>
                </ol>
            </nav>
            <h1 class="mb-0 text-capitalize">Edit {{ str_replace('_', ' ', $section) }}</h1>
        </div>
        <a href="{{ route('admin.page-content.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.page-content.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row g-4">
            @foreach($contents as $content)
                <div class="col-md-6 mb-3">
                    <div class="card bg-transparent border-0">
                        <label class="form-label text-capitalize" style="color: var(--text-muted);">{{ str_replace('_', ' ', $content->key) }}</label>
                        
                        @if($content->type === 'textarea')
                            <textarea name="values[{{ $content->id }}]" class="form-control" rows="4">{{ $content->value }}</textarea>
                        @elseif($content->type === 'image')
                            <div class="d-flex align-items-start gap-3">
                                <img src="{{ asset($content->value) }}" height="80" style="border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);">
                                <div class="flex-grow-1">
                                    <input type="file" name="values[{{ $content->id }}]" class="form-control">
                                    <small class="text-muted d-block mt-1">Recommended: JPG or PNG</small>
                                </div>
                            </div>
                        @else
                            <input type="text" name="values[{{ $content->id }}]" class="form-control" value="{{ $content->value }}">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 pt-4 border-top">
            <button type="submit" class="btn-premium px-5">
                <i class="fa fa-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
