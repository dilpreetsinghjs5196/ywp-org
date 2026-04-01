@extends('admin.layouts.app')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Professional</h1>
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

    <form action="{{ route('admin.professionals.update', $professional->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label text-muted small">Name</label>
                <input type="text" name="user_name" class="form-control @error('user_name') is-invalid @enderror" value="{{ $professional->user_name }}" required>
                @error('user_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small">Qualification</label>
                <input type="text" name="qualification" class="form-control @error('qualification') is-invalid @enderror" value="{{ $professional->qualification }}">
                @error('qualification') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small">Position (Optional)</label>
                <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ $professional->position }}">
                @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small">Gender (Optional)</label>
                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">Select Gender</option>
                    <option value="Male" @if($professional->gender === 'Male') selected @endif>Male</option>
                    <option value="Female" @if($professional->gender === 'Female') selected @endif>Female</option>
                    <option value="Other" @if($professional->gender === 'Other') selected @endif>Other</option>
                </select>
                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label text-muted small">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ $professional->description }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-12">
                <label class="form-label text-muted small">Profile Photo</label>
                <div class="d-flex align-items-start gap-4 mb-3">
                    @if($professional->photo)
                        @php
                            $photoPath = $professional->photo;
                            if ($photoPath && !str_starts_with($photoPath, 'uploads/')) {
                                $photoPath = 'blogadmin/professionnals/images/' . $photoPath;
                            }
                        @endphp
                        <img src="{{ asset($photoPath) }}" height="120" style="border-radius: 15px; border: 2px solid rgba(0,0,0,0.05);">
                    @endif
                    <div class="flex-grow-1">
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                        @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Upload a new photo to replace the current one.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 pt-4 border-top">
            <button type="submit" class="btn-premium px-5">
                <i class="fa fa-save"></i> Update Changes
            </button>
        </div>
    </form>
</div>
@endsection
