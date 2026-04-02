@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-capitalize">Add New Newsletter</h1>
        <a href="{{ route('admin.newsletters.index') }}" class="btn btn-outline-secondary" style="border-radius: 12px; height: 45px; width: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>

    <form action="{{ route('admin.newsletters.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 border rounded text-center" style="background: rgba(0,0,0,0.02); height: 100%;">
                    <div id="imagePreview" style="height: 150px; background: #f1f5f9; border-radius: 15px; display: flex; align-items: center; justify-content: center;" class="mb-3">
                        <i class="fa fa-image text-muted fa-3x"></i>
                    </div>
                    <div class="text-start mb-4">
                        <label class="form-label text-muted small">Cover Image (Optional)</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="text-start">
                        <label class="form-label text-muted small">Upload Newsletter (PDF/DOC)</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label text-muted small">Newsletter Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Summer 2026 Edition" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">Newsletter Year</label>
                        <select name="year" class="form-select" required>
                            @for($y = date('Y') + 1; $y >= 2015; $y--)
                                <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted small">Display Order</label>
                        <input type="number" name="order" class="form-control" value="0">
                    </div>
                </div>

                <div class="p-4 border rounded mt-4" style="background: #f8fafc;">
                    <h5 class="mb-3">Quick Tips</h5>
                    <ul class="text-muted small ps-3">
                        <li class="mb-2">Allowed file types: PDF, DOC, DOCX.</li>
                        <li class="mb-2">Max file size: 10MB.</li>
                        <li class="mb-2">Newsletters will be grouped by year on the website.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-5 border-top pt-4 text-end">
            <button type="submit" class="btn btn-primary" style="background: var(--accent-orange); border: none; padding: 12px 40px; border-radius: 12px; font-weight: 600;">
                <i class="fa fa-save"></i> Save Newsletter
            </button>
        </div>
    </form>
</div>
@endsection
