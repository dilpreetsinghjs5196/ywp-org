@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-capitalize">Edit Newsletter</h1>
        <a href="{{ route('admin.newsletters.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; height: 45px; width: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>

    <form action="{{ route('admin.newsletters.update', $newsletter->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center mb-4 p-4 border rounded" style="background: rgba(0,0,0,0.02);">
                    @if($newsletter->image)
                        <img src="{{ asset($newsletter->image) }}" class="img-fluid rounded shadow-sm mb-3" style="max-height: 200px; border-radius: 15px;">
                    @else
                         <div style="height: 150px; background: #f1f5f9; border-radius: 15px; display: flex; align-items: center; justify-content: center;" class="mb-3">
                            <i class="fa fa-image text-muted fa-3x"></i>
                        </div>
                    @endif
                    <div class="text-start">
                        <label class="form-label text-muted small">Update Cover Image</label>
                        <input type="file" name="image" class="form-control">
                        
                        @if($newsletter->image)
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage">
                                <label class="form-check-label text-danger small" for="removeImage">
                                    <i class="fa fa-trash-alt"></i> Remove & Delete Current Image
                                </label>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="p-4 border rounded mt-4" style="background: #f8fafc;">
                    <h5 class="mb-3">Current File</h5>
                    @if($newsletter->file)
                        <div class="d-flex align-items-center p-3 bg-white border rounded">
                            <i class="fa fa-file-alt fa-2x text-primary me-3"></i>
                            <div>
                                <p class="mb-0 small text-truncate" style="max-width: 150px;">{{ basename($newsletter->file) }}</p>
                                <a href="{{ asset($newsletter->file) }}" target="_blank" class="small text-primary text-decoration-none">View Document</a>
                            </div>
                        </div>
                    @else
                        <p class="text-muted small mb-0">No document uploaded.</p>
                    @endif
                    <div class="text-start mt-4">
                        <label class="form-label text-muted small">Replace Document (PDF/DOC)</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-muted small">Newsletter Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $newsletter->title }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">Newsletter Year</label>
                        <select name="year" class="form-select" required>
                            @for($y = date('Y') + 1; $y >= 2015; $y--)
                                <option value="{{ $y }}" {{ $y == $newsletter->year ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">Display Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $newsletter->order }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 border-top pt-4 text-end">
            <button type="submit" class="btn btn-primary" style="background: var(--accent-orange); border: none; padding: 12px 40px; border-radius: 12px; font-weight: 600;">
                <i class="fa fa-save"></i> Update Newsletter
            </button>
        </div>
    </form>
</div>
@endsection
