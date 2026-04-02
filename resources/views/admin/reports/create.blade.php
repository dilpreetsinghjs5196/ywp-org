@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="mb-4 d-flex align-items-center gap-3">
        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; height: 45px; width: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-arrow-left"></i>
        </a>
        <h1 class="mb-0">Add New Research Paper</h1>
    </div>

    <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-muted small">Paper Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter paper title" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small">Description</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Enter study details..."></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">Read More Link (Google Drive / Doc)</label>
                        <input type="text" name="link" class="form-control" placeholder="https://drive.google.com/...">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">Display Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small">Display Order</label>
                    <input type="number" name="order" class="form-control" value="0" placeholder="0">
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 border rounded" style="background: #f8fafc;">
                    <h5 class="mb-3">Tips</h5>
                    <ul class="text-muted small ps-3">
                        <li class="mb-2">Ensure the drive link is public.</li>
                        <li class="mb-2">Upload a clear cover image for the paper.</li>
                        <li class="mb-2">Lower order number will appear first.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-5 border-top pt-4 text-end">
            <button type="submit" class="btn btn-primary" style="background: var(--accent-orange); border: none; padding: 12px 40px; border-radius: 12px; font-weight: 600;">
                <i class="fa fa-save"></i> Save Paper
            </button>
        </div>
    </form>
</div>
@endsection
