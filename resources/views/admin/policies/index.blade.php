@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-capitalize">Manage Policies</h1>
        <a href="{{ route('admin.policies.create') }}" class="btn btn-success" style="border-radius: 12px; padding: 12px 24px;">
            <i class="fa fa-plus"></i> Add New Policy
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="text-muted small uppercase">
                <tr>
                    <th width="80">Image</th>
                    <th>Policy Info</th>
                    <th width="100">Order</th>
                    <th width="150" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($policies as $policy)
                    <tr>
                        <td>
                            @if($policy->image)
                                <img src="{{ asset($policy->image) }}" width="60" height="60" style="object-fit: cover; border-radius: 10px;">
                            @else
                                <div style="width: 60px; height: 60px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <h6 class="mb-1" style="font-weight: 600;">{{ $policy->title }}</h6>
                            <p class="text-muted small mb-0">{{ Str::limit($policy->description, 80) }}</p>
                            @if($policy->link)
                                <a href="{{ $policy->link }}" target="_blank" class="small text-primary">View Link</a>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px;">{{ $policy->order }}</span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.policies.edit', $policy->id) }}" class="btn btn-outline-primary btn-sm" style="border-radius: 8px;">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.policies.destroy', $policy->id) }}" method="POST" onsubmit="return confirm('Delete this policy?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" style="border-radius: 8px;">
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
