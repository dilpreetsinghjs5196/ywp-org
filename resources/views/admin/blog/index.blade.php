@extends('admin.layouts.app')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Manage Blog Posts</h1>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-success" style="border-radius: 12px; padding: 12px 24px;">
            <i class="fa fa-plus"></i> Add New Post
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
                    <th width="80">Image</th>
                    <th>Post Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th width="120" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $blog)
                    <tr>
                        <td>
                            @if($blog->photo)
                                <img src="{{ asset('storage/' . $blog->photo) }}" width="60" height="60" style="object-fit: cover; border-radius: 10px;">
                            @else
                                <div style="width: 60px; height: 60px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <h6 class="mb-1" style="font-weight: 600;">{{ $blog->title }}</h6>
                            <p class="text-muted small mb-0">{{ $blog->published_at->format('M d, Y') }} | <i class="fa fa-eye"></i> {{ $blog->views }} views</p>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark px-3 py-2" style="border-radius: 8px;">{{ $blog->category->name }}</span>
                        </td>
                        <td>{{ $blog->author }}</td>
                        <td>
                            @if($blog->status == 'publish')
                                <span class="badge bg-success-light text-success px-3 py-2" style="border-radius: 8px;">Published</span>
                            @else
                                <span class="badge bg-warning-light text-warning px-3 py-2" style="border-radius: 8px;">Draft</span>
                            @endif
                            
                            @if($blog->is_editors_choice)
                                <div class="mt-1"><span class="badge bg-info-light text-info small" style="border-radius: 4px;"><i class="fa fa-star"></i> Editor's Choice</span></div>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-outline-primary btn-sm" style="border-radius: 8px;">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this post?')">
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

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection
