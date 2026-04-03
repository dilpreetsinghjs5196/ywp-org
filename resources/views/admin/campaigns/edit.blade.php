@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="mb-4 d-flex align-items-center gap-3">
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; height: 45px; width: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-arrow-left"></i>
        </a>
        <h1 class="mb-0 text-capitalize">Edit Campaign</h1>
    </div>

    <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

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
            <div class="col-md-5">
                <div class="p-4 border rounded shadow-sm" style="background: #ffffff; border-radius: 20px !important;">
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">Thumbnail Photo (Shows on Home Page)</label>
                        @if($campaign->image)
                            <div class="mb-2">
                                <img src="{{ asset($campaign->image) }}" class="img-fluid rounded border" style="max-height: 120px; object-fit: cover; border-radius: 12px;">
                            </div>
                        @else
                            <div class="mb-2 p-3 bg-light rounded text-center small text-muted">No thumbnail photo set</div>
                        @endif
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4 pt-4 border-top">
                        <h6 class="mb-3">Gallery Photos (For Slider)</h6>
                        <div class="row g-3">
                            @foreach($campaign->images as $img)
                                <div class="col-6 position-relative">
                                    <img src="{{ asset($img->image_path) }}" class="img-fluid rounded" style="height: 120px; width: 100%; object-fit: cover; border-radius: 12px;">
                                    <a href="{{ route('admin.campaigns.delete-image', $img->id) }}" 
                                       class="btn btn-danger btn-sm position-absolute top-10 end-10 shadow-sm" 
                                       style="border-radius: 50%; width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center;"
                                       onclick="return confirm('Remove this photo?')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <label class="form-label text-muted small fw-bold">Add More Gallery Photos</label>
                            <input type="file" name="images[]" class="form-control @error('images.*') is-invalid @enderror" multiple>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="mb-4">
                    <label class="form-label text-muted small">Campaign Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $campaign->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted small">Category Label</label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $campaign->category) }}">
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small">Description Snippet</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description', $campaign->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label class="form-label text-muted small">Redirect Link</label>
                        <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $campaign->link) }}">
                        @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 border-top pt-4 text-end">
            <button type="submit" class="btn btn-primary" style="background: var(--accent-orange); border: none; padding: 12px 40px; border-radius: 12px; font-weight: 600;">
                <i class="fa fa-save"></i> Update Campaign
            </button>
        </div>
    </form>
</div>
@endsection
