@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-capitalize">Add New Annual Report</h1>
        <a href="{{ route('admin.annual-reports.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; height: 45px; width: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>

    <form action="{{ route('admin.annual-reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="p-4 border rounded" style="background: rgba(0,0,0,0.02); height: 100%;">
                    <div id="imagePreview" style="height: 150px; background: #f1f5f9; border-radius: 15px; display: flex; align-items: center; justify-content: center;" class="mb-3">
                        <i class="fa fa-image text-muted fa-3x"></i>
                    </div>
                    <div class="text-start">
                        <label class="form-label text-muted small">Upload Cover Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-muted small">Report Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Annual Report YYYY-YYYY" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small">Description</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Summary of the year..."></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">PDF Document Link (Public URL)</label>
                        <input type="text" name="link" class="form-control" placeholder="assets/images/reports/report.pdf">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">Display Order</label>
                        <input type="number" name="order" class="form-control" value="0">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 border-top pt-4 text-end">
            <button type="submit" class="btn btn-primary" style="background: var(--accent-orange); border: none; padding: 12px 40px; border-radius: 12px; font-weight: 600;">
                <i class="fa fa-save"></i> Save Annual Report
            </button>
        </div>
    </form>
</div>
@endsection
