@extends('admin.layouts.app')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">On-Board Professionals</h1>
        <a href="{{ route('admin.professionals.create') }}" class="btn-premium">
            <i class="fa fa-plus"></i> Add Professional
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="text-muted small uppercase">
                <tr>
                    <th width="80">Photo</th>
                    <th>Name</th>
                    <th>Qualification</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($professionals as $pro)
                <tr>
                    <td>
                        @if($pro->photo)
                            @php
                                $photoPath = $pro->photo;
                                if ($photoPath && !str_starts_with($photoPath, 'uploads/')) {
                                    $photoPath = 'blogadmin/professionnals/images/' . $photoPath;
                                }
                            @endphp
                            <img src="{{ asset($photoPath) }}" width="60" height="60" style="object-fit: cover; border-radius: 10px;">
                        @else
                            <div style="width: 60px; height: 60px; background: #eee; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa fa-user text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-bold">{{ $pro->user_name }}</td>
                    <td>{{ $pro->qualification }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.professionals.edit', $pro->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.professionals.destroy', $pro->id) }}" method="POST" onsubmit="return confirm('Delete this professional?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
