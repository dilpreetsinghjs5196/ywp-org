@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="mb-4 d-flex align-items-center gap-3">
        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; height: 45px; width: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-arrow-left"></i>
        </a>
        <h1 class="mb-0 text-capitalize">Edit Research Paper</h1>
    </div>

    <form action="{{ route('admin.reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center mb-4 p-4 border rounded" style="background: rgba(0,0,0,0.02);">
                    @if($report->image)
                        <img src="{{ asset($report->image) }}" class="img-fluid rounded shadow-sm mb-3" style="max-height: 200px; border-radius: 15px;">
                    @else
                         <div style="height: 150px; background: #f1f5f9; border-radius: 15px; display: flex; align-items: center; justify-content: center;" class="mb-3">
                            <i class="fa fa-image text-muted fa-3x"></i>
                        </div>
                    @endif
                    <div class="text-start">
                        <label class="form-label text-muted small">Update Image</label>
                        <input type="file" name="image" class="form-control">
                        
                        @if($report->image)
                            <div class="mt-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage">
                                <label class="form-check-label text-danger small" for="removeImage">
                                    <i class="fa fa-trash-alt"></i> Remove & Delete Current Image
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-muted small">Paper Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $report->title }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ $report->description }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">Read More Link</label>
                        <input type="text" name="link" class="form-control" value="{{ $report->link }}">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">Display Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $report->order }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 border-top pt-4 text-end">
            <button type="submit" class="btn btn-primary" style="background: var(--accent-orange); border: none; padding: 12px 40px; border-radius: 12px; font-weight: 600;">
                <i class="fa fa-save"></i> Update Paper
            </button>
        </div>
    </form>
</div>
@endsection
