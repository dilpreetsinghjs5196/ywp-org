@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Blog Categories</h1>
        <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-success" style="border-radius: 12px; padding: 12px 24px;">
            <i class="fa fa-plus"></i> Add New Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="text-muted small uppercase">
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Posts Count</th>
                    <th width="150" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <h6 class="mb-0" style="font-weight: 600;">{{ $category->name }}</h6>
                        </td>
                        <td><code>{{ $category->slug }}</code></td>
                        <td>
                            <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px;">{{ $category->posts_count }} posts</span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.blog-categories.edit', $category->id) }}" class="btn btn-outline-primary btn-sm" style="border-radius: 8px;">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.blog-categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category? This will delete all associated blog posts.')">
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
