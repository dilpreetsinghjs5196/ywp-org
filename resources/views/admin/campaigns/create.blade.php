@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="mb-4 d-flex align-items-center gap-3">
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; height: 45px; width: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-arrow-left"></i>
        </a>
        <h1 class="mb-0">Create New Campaign</h1>
    </div>

    <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-muted small">Campaign Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. S.P.E.A.K" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted small">Category Label</label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}" placeholder="e.g. School Program">
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Campaign details...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-muted small fw-bold">Thumbnail Photo (Shows on Home Page)</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-muted small fw-bold">Gallery Photos (Slideshow on Campaign Page)</label>
                            <input type="file" name="images[]" class="form-control @error('images.*') is-invalid @enderror" multiple>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small">Redirect Link</label>
                        <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" placeholder="e.g. /campaigns#speak">
                        @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 border rounded" style="background: #f8fafc;">
                    <h5 class="mb-3">Tips</h5>
                    <ul class="text-muted small ps-3">
                        <li class="mb-2">Title should be concise.</li>
                        <li class="mb-2">Image recommended size: 800x600px.</li>
                        <li class="mb-2">Redirect link allows navigation to specific sections.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-5 border-top pt-4 text-end">
            <button type="submit" class="btn btn-primary" style="background: var(--accent-orange); border: none; padding: 12px 40px; border-radius: 12px; font-weight: 600;">
                <i class="fa fa-save"></i> Save Campaign
            </button>
        </div>
    </form>
</div>
@endsection
