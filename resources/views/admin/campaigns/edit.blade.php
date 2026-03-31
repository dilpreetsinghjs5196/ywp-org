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
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center mb-4 p-4 border rounded" style="background: rgba(0,0,0,0.02);">
                    @if($campaign->image)
                        <img src="{{ asset($campaign->image) }}" class="img-fluid rounded shadow-sm mb-3" style="max-height: 200px; border-radius: 15px;">
                    @else
                         <div style="height: 150px; background: #f1f5f9; border-radius: 15px; display: flex; align-items: center; justify-content: center;" class="mb-3">
                            <i class="fa fa-image text-muted fa-3x"></i>
                        </div>
                    @endif
                    <div class="text-start">
                        <label class="form-label text-muted small">Update Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-muted small">Campaign Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $campaign->title }}" required>
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted small">Category Label</label>
                    <input type="text" name="category" class="form-control" value="{{ $campaign->category }}">
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small">Description Snippet</label>
                    <textarea name="description" class="form-control" rows="5">{{ $campaign->description }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label class="form-label text-muted small">Redirect Link</label>
                        <input type="text" name="link" class="form-control" value="{{ $campaign->link }}">
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
