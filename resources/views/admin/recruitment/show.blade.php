@extends('admin.layouts.app')

@section('content')
<div class="glass-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Application Details</h1>
        <a href="{{ route('admin.recruitment.index') }}" class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="item-card p-4 bg-white mb-4">
                <h4 class="mb-3 text-primary border-bottom pb-2">Personal Information</h4>
                <table class="table table-borderless">
                    <tr><th width="150">Full Name</th><td>{{ $application->full_name }}</td></tr>
                    <tr><th>Email</th><td>{{ $application->email }}</td></tr>
                    <tr><th>Age</th><td>{{ $application->age }}</td></tr>
                    <tr><th>Phone</th><td>{{ $application->phone }}</td></tr>
                    <tr><th>Source</th><td>{{ $application->how_did_you_hear_about_us }}</td></tr>
                    <tr><th>Submitted</th><td>{{ $application->created_at->format('d M Y, h:i A') }}</td></tr>
                </table>
            </div>

            <div class="item-card p-4 bg-white mb-4">
                <h4 class="mb-3 text-primary border-bottom pb-2">Department Preferences</h4>
                <table class="table table-borderless">
                    <tr><th width="150">Preference 1</th><td>{{ $application->department_preference_1 }}</td></tr>
                    <tr><th>Preference 2</th><td>{{ $application->department_preference_2 }}</td></tr>
                    <tr><th>Preference 3</th><td>{{ $application->department_preference_3 }}</td></tr>
                </table>
            </div>

            <div class="item-card p-4 bg-white">
                <h4 class="mb-3 text-primary border-bottom pb-2">Other Info</h4>
                <table class="table table-borderless">
                    <tr><th width="150">Discover/HH/Connect</th><td>{{ $application->previous_participation }}</td></tr>
                    <tr><th>Diversity Info</th><td>{{ $application->diversity_info }}</td></tr>
                    <tr>
                        <th>CV / Resume</th>
                        <td>
                            @if($application->cv_path)
                                <a href="{{ asset('storage/' . $application->cv_path) }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-file-download"></i> View CV
                                </a>
                            @else
                                <span class="text-danger">No CV Uploaded</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="item-card p-4 bg-white mb-4 h-100">
                <h4 class="mb-3 text-primary border-bottom pb-2">Questionnaire Answers</h4>
                
                <div class="mb-4">
                    <strong>Other department interests:</strong>
                    <p class="text-muted mt-1">{{ $application->other_department_interests ?: 'N/A' }}</p>
                </div>

                <div class="mb-4">
                    <strong>Motivation to join YWP:</strong>
                    <p class="text-muted mt-1">{{ $application->motivation ?: 'N/A' }}</p>
                </div>

                <div class="mb-4">
                    <strong>Views on mental health in India:</strong>
                    <p class="text-muted mt-1">{{ $application->mental_health_views ?: 'N/A' }}</p>
                </div>

                <div class="mb-4">
                    <strong>Other Information / Links:</strong>
                    <p class="text-muted mt-1">{{ $application->other_info ?: 'N/A' }}</p>
                </div>
                
                <hr>
                
                <form action="{{ route('admin.recruitment.update', $application->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select">
                            <option value="Pending" {{ $application->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Approved" {{ $application->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-premium w-100">Update Application Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
