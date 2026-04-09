@extends('admin.layouts.app')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Recruitment Applications</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="border-radius: 12px; border: none; background: rgba(40, 167, 69, 0.1); color: #28a745;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Dept Pref 1</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                <tr>
                    <td>{{ $app->id }}</td>
                    <td>{{ $app->full_name }}</td>
                    <td>{{ $app->email }}</td>
                    <td>{{ $app->department_preference_1 }}</td>
                    <td>
                        <span class="badge {{ $app->status == 'Approved' ? 'bg-success' : ($app->status == 'Rejected' ? 'bg-danger' : 'bg-warning') }}">
                            {{ $app->status }}
                        </span>
                    </td>
                    <td>{{ $app->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.recruitment.show', $app->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.recruitment.destroy', $app->id) }}" method="POST" onsubmit="return confirm('Delete this application?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
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

    {{ $applications->links() }}

    @if($applications->isEmpty())
        <div class="text-center py-5 text-muted">
             <i class="fa fa-users fa-3x mb-3 opacity-25"></i>
             <p>No recruitment applications found.</p>
        </div>
    @endif
</div>
@endsection
