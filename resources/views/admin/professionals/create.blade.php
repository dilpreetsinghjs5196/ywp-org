@extends('admin.layouts.app')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Professional</h1>
        <a href="{{ route('admin.professionals.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="border-radius: 12px; border: none; background: rgba(220, 53, 69, 0.1); color: #dc3545;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.professionals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label text-muted small">Name</label>
                <input type="text" name="user_name" class="form-control @error('user_name') is-invalid @enderror" value="{{ old('user_name') }}" required>
                @error('user_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small">Qualification</label>
                <input type="text" name="qualification" class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification') }}">
                @error('qualification') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small">Position (Optional)</label>
                <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}">
                @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small">Gender (Optional)</label>
                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label text-muted small">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label text-muted small">Profile Photo</label>
                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <small class="text-muted">Recommended: JPG/PNG, Max 2MB</small>
            </div>
        </div>

        <div class="mt-5 pt-4 border-top">
            <button type="submit" class="btn-premium px-5">
                <i class="fa fa-save"></i> Save Professional
            </button>
        </div>
    </form>
</div>
@endsection
